<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Petpal - Forum</title>
    <meta name="description" content="Petpal Forum">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/flaticon_pet_care.css">
    <link rel="stylesheet" href="assets/css/odometer.css">
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/select2.min.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.css">
    <link rel="stylesheet" href="assets/css/aos.css">
    <link rel="stylesheet" href="assets/css/default.css">
    <link rel="stylesheet" href="assets/css/main.css">

    <style>
        .forum-wrap { padding: 40px 0; }
        .forum-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; flex-wrap:wrap; gap:10px; }
        .topic-list { list-style:none; padding:0; margin:0; }
        .topic-item { padding:14px 16px; border:1px solid #eee; border-radius:6px; margin-bottom:10px; display:flex; justify-content:space-between; align-items:center; background:#fff; cursor:pointer; }
        .topic-title { font-weight:600; margin:0; }
        .topic-meta { color:#777; font-size:0.9rem; }
        .btn-small { padding:6px 10px; font-size:0.9rem; margin-left:6px; }
        .muted { color:#777; font-size:0.9rem; }
        .profile-area { margin-top:20px; }
        .hidden { display:none !important; }

        .modal-backdrop-custom { position:fixed; inset:0; background:rgba(0,0,0,0.5); display:flex; align-items:center; justify-content:center; z-index:9999; }
        .modal-card { width:100%; max-width:720px; background:#fff; border-radius:8px; padding:18px; box-shadow:0 10px 30px rgba(0,0,0,0.15); max-height:90vh; overflow-y:auto; }
        .reply-item { padding:10px; border-bottom:1px solid #eee; }
    </style>
</head>

<body>
    <!--Preloader-->
    <div id="preloader">
        <div id="loader" class="loader">
            <div class="loader-container">
                <div class="loader-icon"><img src="assets/img/logo/preloader.svg" alt="Preloader"></div>
            </div>
        </div>
    </div>

    <!-- Scroll-top -->
    <button class="scroll__top scroll-to-target" data-target="html">
        <i class="fas fa-angle-up"></i>
    </button>

    <!-- header-area -->
    <header>
        <div id="header-fixed-height"></div>
        <div id="sticky-header" class="tg-header__area tg-header__area-three">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tgmenu__wrap">
                            <div class="row align-items-center">
                                <div class="col-xl-5">
                                    <div class="tgmenu__navbar-wrap tgmenu__main-menu d-none d-xl-flex">
                                        <ul class="navigation">
                                            <li><a href="index.html">Home</a></li>
                                            <li><a href="about.html">About</a></li>
                                            <li class="active"><a href="#">Pages</a></li>
                                            <li><a href="contact.html">Contacts</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-4">
                                    <div class="logo text-center">
                                        <a href="index.html"><img src="assets/img/logo/petty.webp" alt="Logo"></a>
                                    </div>
                                </div>
                                <div class="col-xl-5 col-md-8">
                                    <div class="tgmenu__action tgmenu__action-two d-none d-md-block">
                                        <ul class="list-wrap">
                                            <li class="header-search">
                                                <a href="javascript:void(0)" class="search-open-btn">
                                                    <i class="flaticon-loupe"></i>
                                                </a>
                                            </li>
                                            <li class="header-cart">
                                                <a href="javascript:void(0)">
                                                    <i class="flaticon-shopping-bag"></i>
                                                    <span>0</span>
                                                </a>
                                            </li>
                                            <li class="header-btn login-btn"><a href="contact.html" class="btn"><i class="flaticon-locked"></i>Login</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="mobile-nav-toggler">
                                <i class="flaticon-layout"></i>
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-area-end -->

    <!-- main-area -->
    <main>
        <!-- breadcrumb-area -->
        <section class="breadcrumb__area fix">
            <div class="container">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="breadcrumb__content">
                            <h3 class="title">Forum</h3>
                            <nav class="breadcrumb">
                                <span><a href="index.html">Home</a></span>
                                <span class="breadcrumb-separator"><i class="flaticon-right-arrow-angle"></i></span>
                                <span>Forum</span>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="breadcrumb__img">
                            <img src="assets/img/images/breadcrumb_img.png" alt="img" data-aos="fade-left" data-aos-delay="800">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- forum-area -->
        <section class="forum-wrap">
            <div class="container">
                <div class="forum-header">
                    <div>
                        <button id="addTopicBtn" class="btn btn-primary">➕ Add Topic</button>
                        <button id="myProfileBtn" class="btn btn-outline-secondary btn-small">My Profile</button>
                        <button id="allTopicsBtn" class="btn btn-outline-secondary btn-small hidden">All Topics</button>
                    </div>
                    <div class="muted">Showing <span id="topicCount">0</span> topics</div>
                </div>

                <div class="row">
                    <div class="col-lg-8">
                        <ul id="topicsContainer" class="topic-list">
                            <!-- topic items inserted here by JS -->
                        </ul>
                        <div id="emptyMsg" class="muted hidden">No topics yet. Click "Add Topic" to create the first one.</div>
                    </div>
                    <div class="col-lg-4">
                        <aside class="blog-sidebar">
                            <div class="blog-widget">
                                <h4 class="widget-title">Search</h4>
                                <div class="sidebar-search-form">
                                    <form id="searchForm">
                                        <input type="text" id="searchInput" placeholder="Search topics...">
                                        <button type="submit"><i class="flaticon-loupe"></i></button>
                                    </form>
                                </div>
                            </div>
                            <div class="blog-widget">
                                <h4 class="widget-title">Categories</h4>
                                <div class="sidebar-cat-list">
                                    <ul class="list-wrap">
                                        <li><a href="#" data-cat="all">All</a></li>
                                        <li><a href="#" data-cat="general">General</a></li>
                                        <li><a href="#" data-cat="help">Help</a></li>
                                        <li><a href="#" data-cat="announcements">Announcements</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="blog-widget profile-area hidden" id="profileArea">
                                <h4 class="widget-title">My Topics</h4>
                                <div id="myTopicsList"></div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Modals root -->
    <div id="modalRoot" class="hidden"></div>

    <!-- footer-area -->
    <footer>
        <div class="footer__area fix">
            <div class="footer__newsletter-three">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-5">
                            <div class="footer__newsletter-content">
                                <h2 class="title">Sign Up For Newsletter!</h2>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <form action="#" class="footer__newsletter-form-two">
                                <input type="email" placeholder="Type Your E-mail">
                                <button type="submit">Subscribe <img src="assets/img/icon/right_arrow04.svg" alt="" class="injectable"></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ... rest of footer ... -->
        </div>
    </footer>

    <!-- JS here -->
    <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/jquery.odometer.min.js"></script>
    <script src="assets/js/jquery.appear.js"></script>
    <script src="assets/js/swiper-bundle.min.js"></script>
    <script src="assets/js/jquery.countdown.min.js"></script>
    <script src="assets/js/svg-inject.min.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    <script src="assets/js/ajax-form.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/aos.js"></script>
    <script src="assets/js/main.js"></script>

    <script>SVGInject(document.querySelectorAll("img.injectable"));</script>

    <!-- Forum script (pure DB, no localStorage) -->
    <script>
    (function () {
        // === CONFIG: BACKEND ROUTES (MVC) ===
        const baseUrl = 'index.php?controller=forum&action=';

        const api = {
            list:  baseUrl + 'topics',
            get:   baseUrl + 'topic',
            create: baseUrl + 'create',
            update: baseUrl + 'update',
            delete: baseUrl + 'delete',
            reply:  baseUrl + 'reply'
        };

        // Simulated logged user (must match users table)
        const currentUser = { id: 1, username: 'alice', role: 'user' };

        // DOM refs
        const topicsContainer = document.getElementById('topicsContainer');
        const topicCount = document.getElementById('topicCount');
        const emptyMsg = document.getElementById('emptyMsg');
        const addTopicBtn = document.getElementById('addTopicBtn');
        const myProfileBtn = document.getElementById('myProfileBtn');
        const allTopicsBtn = document.getElementById('allTopicsBtn');
        const profileArea = document.getElementById('profileArea');
        const myTopicsList = document.getElementById('myTopicsList');
        const modalRoot = document.getElementById('modalRoot');
        const searchForm = document.getElementById('searchForm');
        const searchInput = document.getElementById('searchInput');

        function escapeHTML(str) {
            if (!str && str !== 0) return '';
            return String(str)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        function normalizeTopic(t) {
            return {
                ...t,
                userId: t.userId ?? t.user_id ?? null,
                replies: Array.isArray(t.replies) ? t.replies : []
            };
        }

        // ==== Backend calls (all DB) ====
        async function fetchTopics() {
            const res = await fetch(api.list, { credentials: 'same-origin' });
            if (!res.ok) throw new Error('Failed to load topics');
            const data = await res.json();
            return Array.isArray(data) ? data.map(normalizeTopic) : [];
        }

        async function fetchTopicById(id) {
            const res = await fetch(api.get + '&id=' + encodeURIComponent(id), { credentials: 'same-origin' });
            if (!res.ok) throw new Error('Failed to load topic');
            const t = await res.json();
            return normalizeTopic(t);
        }

        async function createTopic(payload) {
            const res = await fetch(api.create, {
                method: 'POST',
                credentials: 'same-origin',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });
            if (!res.ok) throw new Error('Failed to create topic');
            const t = await res.json();
            return normalizeTopic(t);
        }

        async function updateTopic(id, payload) {
            const res = await fetch(api.update, {
                method: 'POST',
                credentials: 'same-origin',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id, ...payload })
            });
            if (!res.ok) throw new Error('Failed to update topic');
            const t = await res.json();
            return normalizeTopic(t);
        }

        async function deleteTopic(id) {
            const res = await fetch(api.delete, {
                method: 'POST',
                credentials: 'same-origin',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id })
            });
            if (!res.ok) throw new Error('Failed to delete topic');
            return await res.json();
        }

        async function addReply(topicId, content) {
            const res = await fetch(api.reply, {
                method: 'POST',
                credentials: 'same-origin',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    topicId,
                    reply: { content }
                })
            });
            if (!res.ok) throw new Error('Failed to add reply');
            return await res.json();
        }

        // === Rendering ===
        let currentTopics = [];

        async function loadTopics() {
            try {
                currentTopics = await fetchTopics();
                renderTopics({ q: searchInput.value.trim(), category: currentCategory });
                renderProfile();
            } catch (e) {
                console.error(e);
                alert('Could not load topics from server');
            }
        }

        function renderTopics(filter = {}) {
            let topics = currentTopics.slice();

            const q = (filter.q || '').toLowerCase();
            const cat = (filter.category || 'all').toLowerCase();

            if (q) {
                topics = topics.filter(t =>
                    (t.title || '').toLowerCase().includes(q) ||
                    (t.content || '').toLowerCase().includes(q)
                );
            }
            if (cat !== 'all') {
                topics = topics.filter(t => (t.category || '').toLowerCase() === cat);
            }

            topicsContainer.innerHTML = '';
            topicCount.textContent = topics.length;
            if (topics.length === 0) {
                emptyMsg.classList.remove('hidden');
            } else {
                emptyMsg.classList.add('hidden');
            }

            topics.forEach(topic => {
                const li = document.createElement('li');
                li.className = 'topic-item';

                const main = document.createElement('div');
                main.style.flex = '1';

                const titleEl = document.createElement('p');
                titleEl.className = 'topic-title';
                titleEl.innerHTML = escapeHTML(topic.title || '(no title)');

                const metaEl = document.createElement('div');
                metaEl.className = 'topic-meta';
                const repliesCount = topic.replies.length;
                const d = topic.created_at ? new Date(topic.created_at) : new Date();
                metaEl.textContent = `by ${topic.username || 'unknown'} · ${d.toLocaleString()} · ${repliesCount} replies`;

                main.appendChild(titleEl);
                main.appendChild(metaEl);

                const actions = document.createElement('div');

                const openBtn = document.createElement('button');
                openBtn.className = 'btn btn-link';
                openBtn.innerText = 'Open';
                openBtn.onclick = e => { e.stopPropagation(); openTopicModal(topic.id); };
                actions.appendChild(openBtn);

                if (String(topic.userId) === String(currentUser.id) || currentUser.role === 'admin') {
                    const editBtn = document.createElement('button');
                    editBtn.className = 'btn btn-outline-secondary btn-small';
                    editBtn.innerText = 'Edit';
                    editBtn.onclick = e => { e.stopPropagation(); openCreateModal(topic); };
                    actions.appendChild(editBtn);

                    const delBtn = document.createElement('button');
                    delBtn.className = 'btn btn-danger btn-small';
                    delBtn.innerText = 'Delete';
                    delBtn.onclick = async e => {
                        e.stopPropagation();
                        if (!confirm('Delete this topic?')) return;
                        try {
                            await deleteTopic(topic.id);
                            await loadTopics();
                        } catch (err) {
                            console.error(err);
                            alert('Delete failed');
                        }
                    };
                    actions.appendChild(delBtn);
                }

                li.appendChild(main);
                li.appendChild(actions);
                li.addEventListener('click', () => openTopicModal(topic.id));

                topicsContainer.appendChild(li);
            });
        }

        function showModal(contentEl, titleText = '') {
            modalRoot.innerHTML = '';
            modalRoot.classList.remove('hidden');

            const backdrop = document.createElement('div');
            backdrop.className = 'modal-backdrop-custom';

            const card = document.createElement('div');
            card.className = 'modal-card';

            if (titleText) {
                const h = document.createElement('h4');
                h.textContent = titleText;
                h.style.marginBottom = '10px';
                card.appendChild(h);
            }

            card.appendChild(contentEl);
            backdrop.appendChild(card);
            modalRoot.appendChild(backdrop);

            backdrop.addEventListener('click', e => {
                if (e.target === backdrop) closeModal();
            });
        }

        function closeModal() {
            modalRoot.innerHTML = '';
            modalRoot.classList.add('hidden');
        }

        function openCreateModal(topic = null) {
            const isEdit = !!topic;

            const wrap = document.createElement('div');

            const titleInput = document.createElement('input');
            titleInput.className = 'form-control';
            titleInput.placeholder = 'Title';
            titleInput.style.marginBottom = '10px';

            const categoryInput = document.createElement('select');
            categoryInput.className = 'form-control';
            categoryInput.style.marginBottom = '10px';
            categoryInput.innerHTML = `
                <option value="general">General</option>
                <option value="help">Help</option>
                <option value="announcements">Announcements</option>
            `;

            const contentInput = document.createElement('textarea');
            contentInput.className = 'form-control';
            contentInput.placeholder = 'Write your topic content here...';
            contentInput.style.minHeight = '140px';

            if (isEdit) {
                titleInput.value = topic.title || '';
                categoryInput.value = topic.category || 'general';
                contentInput.value = topic.content || '';
            }

            const btnRow = document.createElement('div');
            btnRow.style.marginTop = '12px';
            btnRow.style.textAlign = 'right';

            const cancelBtn = document.createElement('button');
            cancelBtn.className = 'btn btn-outline-secondary';
            cancelBtn.innerText = 'Cancel';
            cancelBtn.onclick = () => closeModal();

            const saveBtn = document.createElement('button');
            saveBtn.className = 'btn btn-primary';
            saveBtn.style.marginLeft = '8px';
            saveBtn.innerText = isEdit ? 'Save' : 'Post';

            saveBtn.onclick = async () => {
                const title = titleInput.value.trim();
                const content = contentInput.value.trim();
                const category = categoryInput.value;

                if (!title || !content) {
                    alert('Title and content are required');
                    return;
                }
                try {
                    if (isEdit) {
                        await updateTopic(topic.id, { title, content, category });
                    } else {
                        await createTopic({ title, content, category });
                    }
                    closeModal();
                    await loadTopics();
                } catch (err) {
                    console.error(err);
                    alert('Failed to save topic');
                }
            };

            btnRow.appendChild(cancelBtn);
            btnRow.appendChild(saveBtn);

            wrap.appendChild(titleInput);
            wrap.appendChild(categoryInput);
            wrap.appendChild(contentInput);
            wrap.appendChild(btnRow);

            showModal(wrap, isEdit ? 'Edit Topic' : 'Create Topic');
        }

        async function openTopicModal(id) {
            try {
                const topic = await fetchTopicById(id);

                const wrap = document.createElement('div');

                const titleEl = document.createElement('h3');
                titleEl.textContent = topic.title;
                wrap.appendChild(titleEl);

                const metaEl = document.createElement('div');
                metaEl.className = 'muted';
                const d = topic.created_at ? new Date(topic.created_at) : new Date();
                metaEl.textContent = `by ${topic.username || 'unknown'} · ${d.toLocaleString()}`;
                wrap.appendChild(metaEl);

                const contentEl = document.createElement('p');
                contentEl.style.margin = '12px 0';
                contentEl.innerHTML = escapeHTML(topic.content || '').replace(/\n/g, '<br>');
                wrap.appendChild(contentEl);

                const actionRow = document.createElement('div');
                actionRow.style.marginBottom = '10px';
                if (String(topic.userId) === String(currentUser.id) || currentUser.role === 'admin') {
                    const delBtn = document.createElement('button');
                    delBtn.className = 'btn btn-danger btn-small';
                    delBtn.innerText = 'Delete';
                    delBtn.onclick = async () => {
                        if (!confirm('Delete this topic?')) return;
                        await deleteTopic(topic.id);
                        closeModal();
                        await loadTopics();
                    };
                    actionRow.appendChild(delBtn);

                    const editBtn = document.createElement('button');
                    editBtn.className = 'btn btn-outline-secondary btn-small';
                    editBtn.style.marginLeft = '8px';
                    editBtn.innerText = 'Edit';
                    editBtn.onclick = () => openCreateModal(topic);
                    actionRow.appendChild(editBtn);
                }
                wrap.appendChild(actionRow);

                const repliesTitle = document.createElement('h5');
                repliesTitle.textContent = 'Replies';
                wrap.appendChild(repliesTitle);

                const repliesBox = document.createElement('div');
                repliesBox.style.maxHeight = '260px';
                repliesBox.style.overflowY = 'auto';

                (topic.replies || []).forEach(r => {
                    const rEl = document.createElement('div');
                    rEl.className = 'reply-item';
                    const name = document.createElement('strong');
                    name.textContent = r.username || 'user';
                    const date = document.createElement('span');
                    date.className = 'muted';
                    date.style.marginLeft = '8px';
                    const rd = r.created_at ? new Date(r.created_at) : new Date();
                    date.textContent = rd.toLocaleString();
                    const body = document.createElement('div');
                    body.style.marginTop = '4px';
                    body.innerHTML = escapeHTML(r.content || '').replace(/\n/g, '<br>');
                    rEl.appendChild(name);
                    rEl.appendChild(date);
                    rEl.appendChild(body);
                    repliesBox.appendChild(rEl);
                });

                if (!topic.replies || topic.replies.length === 0) {
                    const noEl = document.createElement('div');
                    noEl.className = 'muted';
                    noEl.textContent = 'No replies yet. Be the first to reply!';
                    repliesBox.appendChild(noEl);
                }

                wrap.appendChild(repliesBox);

                const replyBox = document.createElement('div');
                replyBox.style.marginTop = '12px';

                const replyTextarea = document.createElement('textarea');
                replyTextarea.className = 'form-control';
                replyTextarea.placeholder = 'Write a reply...';
                replyTextarea.style.minHeight = '80px';

                const replyBtnRow = document.createElement('div');
                replyBtnRow.style.textAlign = 'right';
                replyBtnRow.style.marginTop = '8px';

                const cancelReply = document.createElement('button');
                cancelReply.className = 'btn btn-outline-secondary';
                cancelReply.textContent = 'Cancel';
                cancelReply.onclick = () => replyTextarea.value = '';

                const postReply = document.createElement('button');
                postReply.className = 'btn btn-primary';
                postReply.style.marginLeft = '8px';
                postReply.textContent = 'Add Reply';
                postReply.onclick = async () => {
                    const content = replyTextarea.value.trim();
                    if (!content) return;
                    try {
                        await addReply(topic.id, content);
                        openTopicModal(topic.id); // reload topic with new reply
                    } catch (err) {
                        console.error(err);
                        alert('Failed to add reply');
                    }
                };

                replyBtnRow.appendChild(cancelReply);
                replyBtnRow.appendChild(postReply);
                replyBox.appendChild(replyTextarea);
                replyBox.appendChild(replyBtnRow);

                wrap.appendChild(replyBox);

                showModal(wrap, 'Topic');

            } catch (e) {
                console.error(e);
                alert('Failed to open topic');
            }
        }

        async function renderProfile() {
            const myTopics = currentTopics.filter(t => String(t.userId) === String(currentUser.id));
            myTopicsList.innerHTML = '';
            if (myTopics.length === 0) {
                myTopicsList.innerHTML = '<div class="muted">You have not created any topics yet.</div>';
                return;
            }
            myTopics.forEach(t => {
                const div = document.createElement('div');
                div.style.marginBottom = '10px';
                div.innerHTML = `
                    <strong>${escapeHTML(t.title || '')}</strong>
                    <div class="muted">${(t.replies || []).length} replies · ${new Date(t.created_at || Date.now()).toLocaleString()}</div>
                `;
                const editBtn = document.createElement('button');
                editBtn.className = 'btn btn-outline-secondary btn-small';
                editBtn.style.marginTop = '4px';
                editBtn.textContent = 'Edit';
                editBtn.onclick = () => openCreateModal(t);

                const delBtn = document.createElement('button');
                delBtn.className = 'btn btn-danger btn-small';
                delBtn.style.marginTop = '4px';
                delBtn.style.marginLeft = '6px';
                delBtn.textContent = 'Delete';
                delBtn.onclick = async () => {
                    if (!confirm('Delete this topic?')) return;
                    await deleteTopic(t.id);
                    await loadTopics();
                };

                div.appendChild(editBtn);
                div.appendChild(delBtn);
                myTopicsList.appendChild(div);
            });
        }

        let currentCategory = 'all';

        // Events
        addTopicBtn.addEventListener('click', () => openCreateModal());
        myProfileBtn.addEventListener('click', () => {
            profileArea.classList.remove('hidden');
            myProfileBtn.classList.add('hidden');
            allTopicsBtn.classList.remove('hidden');
            renderProfile();
        });
        allTopicsBtn.addEventListener('click', () => {
            profileArea.classList.add('hidden');
            myProfileBtn.classList.remove('hidden');
            allTopicsBtn.classList.add('hidden');
        });

        searchForm.addEventListener('submit', e => {
            e.preventDefault();
            renderTopics({ q: searchInput.value.trim(), category: currentCategory });
        });

        document.querySelectorAll('.sidebar-cat-list a').forEach(a => {
            a.addEventListener('click', e => {
                e.preventDefault();
                currentCategory = (a.dataset.cat || 'all').toLowerCase();
                renderTopics({ q: searchInput.value.trim(), category: currentCategory });
            });
        });

        // initial load
        loadTopics();

        // for debugging
        window.__forum = { loadTopics };
    })();
    </script>
</body>
</html>
