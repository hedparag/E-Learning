import $ from 'jquery';
window.$ = window.jQuery = $;

document.addEventListener('DOMContentLoaded', function () {
    const links = document.querySelectorAll('#dashboard-tabs .nav-link');
    const content = document.getElementById('dashboard-tab-content');

    if (!links.length || !content) return;

    function updateActiveTab(clickedLink) {
        links.forEach(link => link.classList.remove('active'));
        clickedLink.classList.add('active');
    }

    links.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();

            const href = this.getAttribute('href');

            updateActiveTab(this); // 🔥 Highlight active tab

            fetch(href, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => {
                    if (!response.ok) throw new Error('Failed to load content');
                    return response.text();
                })
                .then(html => {
                    content.innerHTML = html;
                    history.pushState(null, '', href); // 🔄 Update URL in address bar
                })
                .catch(error => {
                    content.innerHTML = `<div class="alert alert-danger">Error loading content</div>`;
                    console.error(error);
                });
        });
    });

    // 🔁 Handle back/forward browser buttons
    window.addEventListener('popstate', () => {
        const currentURL = window.location.href;
        const activeLink = [...links].find(link => link.href === currentURL);

        if (activeLink) {
            updateActiveTab(activeLink);
            fetch(currentURL, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
                .then(res => res.text())
                .then(html => content.innerHTML = html);
        }
    });
});
