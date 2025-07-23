// $(document).on('click', '.ajax-nav', function (e) {
//     e.preventDefault();
//     let url = $(this).data('url');

//     $.ajax({
//         url: url,
//         type: 'GET',
//         beforeSend: function () {
//             $('.ajax-area').html('<p>Loading...</p>'); // Optional loading text
//         },
//         success: function (response) {
//             $('.ajax-area').html(response);
//         },
//         error: function (xhr) {
//             $('.ajax-area').html('<p>Error loading content.</p>');
//         }
//     });
// });


$(document).on('click', '.ajax-nav', function (e) {
    e.preventDefault();
    let url = $(this).data('url');

    $.ajax({
        url: url,
        type: 'GET',
        beforeSend: function () {
            $('.ajax-area').html('<div class="preloader">Loading...</div>'); // You can style this
        },
        success: function (response) {
            $('.ajax-area').html(response);

            // ✅ Re-run scripts like sliders, tooltips, etc. that rely on the new DOM
            if (typeof mainSlider === 'function') {
                mainSlider();
            }

            // You can add more re-initializers if needed
            // e.g., if using AOS.init() or other plugins
        },
        error: function (xhr) {
            $('.ajax-area').html('<div class="alert alert-danger">Error loading content.</div>');
            console.error(xhr);
        }
    });
});
