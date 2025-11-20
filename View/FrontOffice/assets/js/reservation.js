// Global calendar state
let CAL_TODAY = new Date();
let CAL_BASE_YEAR = CAL_TODAY.getFullYear();
let CAL_BASE_MONTH = CAL_TODAY.getMonth(); // 0..11
let calYear = CAL_BASE_YEAR;
let calMonth = CAL_BASE_MONTH; // currently displayed month

// max offset: 0 = this month, 1 = next month, 2 = month after next
const MAX_MONTH_OFFSET = 2;

// Helpers
function toISODate(d) {
  const year = d.getFullYear();
  const month = String(d.getMonth() + 1).padStart(2, "0");
  const day = String(d.getDate()).padStart(2, "0");
  return `${year}-${month}-${day}`;
}

function monthOffset(year, month) {
  return (year - CAL_BASE_YEAR) * 12 + (month - CAL_BASE_MONTH);
}

function showTimeslotSection() {
  const sec = document.getElementById("timeslot-section");
  if (sec) sec.classList.remove("hidden");
}

// ---- Calendar generation with month navigation ----
function generateCalendar(year, month) {
  const grid = document.getElementById("calendar-grid");
  const title = document.getElementById("calendar-title");
  if (!grid || !title) return;

  grid.innerHTML = "";

  const firstDay = new Date(year, month, 1);
  const lastDay = new Date(year, month + 1, 0);
  const today = CAL_TODAY;

  // Title: "May 2025"
  title.textContent = firstDay.toLocaleDateString("en-US", {
    month: "long",
    year: "numeric",
  });

  // JS getDay(): Sun=0..Sat=6; we want Mon=0..Sun=6
  const jsDay = firstDay.getDay();
  const mondayIndex = (jsDay + 6) % 7;

  // Empty cells before the 1st
  for (let i = 0; i < mondayIndex; i++) {
    const empty = document.createElement("div");
    empty.className = "calendar-day empty-day";
    grid.appendChild(empty);
  }

  const todayMid = new Date(
    today.getFullYear(),
    today.getMonth(),
    today.getDate()
  );
  let todayCell = null;

  for (let day = 1; day <= lastDay.getDate(); day++) {
    const d = new Date(year, month, day);
    const cell = document.createElement("div");
    cell.className = "calendar-day";
    cell.textContent = day;

    const iso = toISODate(d);
    cell.dataset.date = iso;

    // Sunday in red
    if (d.getDay() === 0) {
      cell.classList.add("sunday");
    }

    const dMid = new Date(d.getFullYear(), d.getMonth(), d.getDate());

    // Past day? (before today) => disabled
    if (dMid < todayMid) {
      cell.classList.add("past");
    } else {
      cell.addEventListener("click", function () {
        selectDateCell(this);
      });
    }

    // Today marker
    if (
      d.getFullYear() === today.getFullYear() &&
      d.getMonth() === today.getMonth() &&
      d.getDate() === today.getDate()
    ) {
      cell.classList.add("today");
      todayCell = cell;
    }

    grid.appendChild(cell);
  }

  // After rendering, mark days that have NO slots (grey)
  markNoSlotsForMonth(year, month);

  // Auto-select today only if we are on base month
  if (
    year === CAL_BASE_YEAR &&
    month === CAL_BASE_MONTH &&
    todayCell &&
    !todayCell.classList.contains("past")
  ) {
    selectDateCell(todayCell, true);
  } else {
    // Clear date & table text if not current month
    const dateInput = document.getElementById("appointment_date");
    if (dateInput) dateInput.value = "";
    const helper = document.getElementById("timeslot-helper");
    if (helper) helper.textContent = "Choose a date to see available times.";
    const body = document.getElementById("timeslot-body");
    if (body) body.innerHTML = "";
  }

  updateNavButtons();
}

function updateNavButtons() {
  const prevBtn = document.getElementById("prev-month");
  const nextBtn = document.getElementById("next-month");
  if (!prevBtn || !nextBtn) return;

  const offset = monthOffset(calYear, calMonth);

  // Prev: disabled if we are at base month
  prevBtn.disabled = offset <= 0;

  // Next: disabled if we reached base + MAX_MONTH_OFFSET
  nextBtn.disabled = offset >= MAX_MONTH_OFFSET;
}

function selectDateCell(cell, auto = false) {
  // Ignore clicks on disabled or no-slot days
  if (cell.classList.contains("past") || cell.classList.contains("no-slots")) {
    return;
  }

  document
    .querySelectorAll(".calendar-day")
    .forEach((c) => c.classList.remove("selected"));
  cell.classList.add("selected");

  const date = cell.dataset.date;
  const hiddenDate = document.getElementById("appointment_date");
  if (hiddenDate) {
    hiddenDate.value = date;
  }

  loadTimeSlots(date);
}

// ---- Mark days that have no timeslots ----
// This calls your existing TimeslotController.php?action=byDate
// for each future day in that month.
// If the response is empty => mark .no-slots
function markNoSlotsForMonth(year, month) {
  const vetId = window.RESERVATION_VET_ID || 1;
  const today = CAL_TODAY;
  const todayMid = new Date(
    today.getFullYear(),
    today.getMonth(),
    today.getDate()
  );

  const lastDay = new Date(year, month + 1, 0).getDate();

  for (let day = 1; day <= lastDay; day++) {
    const d = new Date(year, month, day);
    const dMid = new Date(d.getFullYear(), d.getMonth(), d.getDate());

    // Skip past days
    if (dMid < todayMid) continue;

    const iso = toISODate(d);

    const xhr = new XMLHttpRequest();
    xhr.open(
      "GET",
      "../../Controllers/timeslotcontroller.php?action=byDate&vet_id=" +
        encodeURIComponent(vetId) +
        "&date=" +
        encodeURIComponent(iso),
      true
    );

    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        try {
          const slots = JSON.parse(xhr.responseText);
          if (!slots || slots.length === 0) {
            const cell = document.querySelector(
              '.calendar-day[data-date="' + iso + '"]'
            );
            if (cell) {
              cell.classList.add("no-slots");
            }
          }
        } catch (e) {
          console.error("Error parsing JSON for date", iso, e);
        }
      }
    };

    xhr.send();
  }
}

// ---- Timeslots: striped table ----
// ---- Timeslots: striped table ----
function clearTimeslots() {
  const body = document.getElementById("timeslot-body");
  const helper = document.getElementById("timeslot-helper");
  if (body) body.innerHTML = "";
  if (helper) helper.textContent = "Loading times for this day...";
}

function loadTimeSlots(date) {
  showTimeslotSection(); // make the table area visible
  clearTimeslots();

  const helper = document.getElementById("timeslot-helper");
  const vetId = window.RESERVATION_VET_ID || 1;

  const xhr = new XMLHttpRequest();
  xhr.open(
    "GET",
    "../../Controllers/timeslotcontroller.php?action=byDate&vet_id=" +
      encodeURIComponent(vetId) +
      "&date=" +
      encodeURIComponent(date),
    true
  );

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        try {
          const slots = JSON.parse(xhr.responseText);
          renderTimeslots(slots);
        } catch (e) {
          console.error("Error parsing slots JSON", e);
          if (helper)
            helper.textContent = "An error occurred while loading times.";
        }
      } else {
        if (helper)
          helper.textContent = "Could not load timeslots. Please try again.";
      }
    }
  };

  xhr.send();
}

function renderTimeslots(slots) {
  const body = document.getElementById("timeslot-body");
  const helper = document.getElementById("timeslot-helper");
  if (!body) return;

  body.innerHTML = "";

  // If the backend returns no slots at all
  if (!slots || slots.length === 0) {
    if (helper) helper.textContent = "No times available for this date.";
    return;
  }

  // We assume backend sends BOTH booked + available 30min slots
  // Example of each item:
  // { id: 5, start_time: "09:00", end_time: "09:30", status: "booked" or "free", is_available: 1/0 }
  slots.forEach((slot) => {
    const tr = document.createElement("tr");

    const timeTd = document.createElement("td");
    timeTd.textContent = `${slot.start_time} - ${slot.end_time}`;

    const statusTd = document.createElement("td");
    const badge = document.createElement("span");
    badge.classList.add("status-badge");

    const isBooked =
      slot.status === "booked" || String(slot.is_available) === "0";

    if (isBooked) {
      // OCCUPIED
      badge.classList.add("status-booked");
      badge.textContent = "Occupied";
      // row not clickable
    } else {
      // FREE
      tr.classList.add("available");
      badge.classList.add("status-available");
      badge.textContent = "Free";

      tr.addEventListener("click", function () {
        selectTimeslotRow(this, slot.id);
      });
    }

    statusTd.appendChild(badge);
    tr.appendChild(timeTd);
    tr.appendChild(statusTd);
    body.appendChild(tr);
  });

  if (helper) {
    helper.textContent =
      "Click on a free time (green) to select your appointment.";
  }
}

function selectTimeslotRow(row, slotId) {
  document
    .querySelectorAll(".timeslot-table tr.available")
    .forEach((tr) => tr.classList.remove("selected-row"));

  row.classList.add("selected-row");

  const hidden = document.getElementById("timeslot_id");
  if (hidden) {
    hidden.value = slotId;
  }
}

// ---- Form validation + patient_name build ----
function initReservationForm() {
  const form = document.getElementById("appointmentForm");
  if (!form) return;

  form.addEventListener("submit", function (e) {
    const errors = [];

    console.log(document.getElementById("visit_reason"));
    const firstName = document.getElementById("first_name");
    const lastName = document.getElementById("last_name");
    const phone = document.getElementById("patient_phone");
    const species = document.getElementById("species");
    const reason = document.getElementById("visit_reason");
    const dateInput = document.getElementById("appointment_date");
    const timeslotInput = document.getElementById("timeslot_id");
    const patientNameHidden = document.getElementById("patient_name");

    if (!firstName || !firstName.value.trim()) {
      errors.push("First name is required.");
    }

    if (!lastName || !lastName.value.trim()) {
      errors.push("Last name is required.");
    }

    if (!phone || !phone.value.trim()) {
      errors.push("Phone number is required.");
    }

    if (!species || !species.value) {
      errors.push("Animal type (species) is required.");
    }

    if (!reason || !reason.value.trim()) {
      errors.push("Reason for appointment is required.");
    }

    if (!dateInput || !dateInput.value) {
      errors.push("Please select a date from the calendar.");
    }

    if (!timeslotInput || !timeslotInput.value) {
      errors.push("Please choose an available time.");
    }

    if (errors.length > 0) {
      alert(errors.join("\n"));
      e.preventDefault();
      return;
    }

    // Build patient_name = "First Last" for backend
    if (patientNameHidden && firstName && lastName) {
      patientNameHidden.value =
        firstName.value.trim() + " " + lastName.value.trim();
    }
  });
}

// ---- Init when DOM ready ----
document.addEventListener("DOMContentLoaded", function () {
  // get vet id for AJAX
  const vetIdInput = document.querySelector('input[name="vet_id"]');
  if (vetIdInput) {
    window.RESERVATION_VET_ID = vetIdInput.value;
  }

  // Prev / next handlers
  const prevBtn = document.getElementById("prev-month");
  const nextBtn = document.getElementById("next-month");

  if (prevBtn) {
    prevBtn.addEventListener("click", function () {
      const offset = monthOffset(calYear, calMonth);
      if (offset <= 0) return; // cannot go before base month
      if (calMonth === 0) {
        calMonth = 11;
        calYear -= 1;
      } else {
        calMonth -= 1;
      }
      generateCalendar(calYear, calMonth);
    });
  }

  if (nextBtn) {
    nextBtn.addEventListener("click", function () {
      const offset = monthOffset(calYear, calMonth);
      if (offset >= MAX_MONTH_OFFSET) return; // cannot exceed limit
      if (calMonth === 11) {
        calMonth = 0;
        calYear += 1;
      } else {
        calMonth += 1;
      }
      generateCalendar(calYear, calMonth);
    });
  }

  generateCalendar(calYear, calMonth);
  initReservationForm();
});

// When a date is selected
function onDateSelected(isoDate) {
  document.getElementById("appointment_date").value = isoDate;
}

// When a timeslot is selected
function onTimeslotSelected(slot) {
  document.getElementById("timeslot_id").value = slot.id;
}

// Before submitting the form
document
  .getElementById("appointmentForm")
  .addEventListener("submit", function (event) {
    const fname = document.getElementById("first_name").value.trim();
    const lname = document.getElementById("last_name").value.trim();
    document.getElementById("patient_name").value = fname + " " + lname;
  });
