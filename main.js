
$(document).ready(function() {

    $('.portfolio-grid img:not(.matrix-image)').addClass('matrix-image');

    const $menuToggle = $('#menu-toggle');
    const $navLinks = $('#nav-links');

    $menuToggle.on('click', function() {
        $(this).toggleClass('active');
        $navLinks.toggleClass('open');
    });

    // open lightbox on tile click
    $('.tile').on('click', function(e) {
        e.preventDefault();

        // Example: show project info dynamically
        //         const title = $(this).find('.project-title').text() || 'Untitled';
        //         const img = $(this).find('img').attr('src') || '';
        //         const description = `
        //   <h2>${title}</h2>
        //   ${img ? `<img src="${img}" alt="${title}" style="width:100%; border-radius:8px; margin-top:15px;">` : ''}
        //   <p style="margin-top:20px;">Custom HTML for <b>${title}</b>.
        //   Add anything here — paragraphs, code blocks, YouTube embeds, etc.</p>
        // `;
        //
        //         $('#lightbox .lightbox-body').html(description);
        let $this = $(this);
        let this_id = $this.attr('data-id');
        let category = $this.attr('data-type');

        if (category == 'labs') {
            let link = $this.attr('data-link');
            window.open(link, '_blank');
            return;
        }

        $('#lightbox .lightbox-body').html('');
        $('#matrixSpinner').show();

        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            data: {
                action: 'pcontent',
                post_id: this_id
            },
            method: 'POST',
            type: 'POST',
            dataType: 'html',
            success: function(data) {
                let filter_data = $(data);
                filter_data.find('a').replaceWith(function() {
                    return $(this).contents();
                });
                $('#lightbox .lightbox-body').html(filter_data);

                $('#lightbox').fadeIn(300).css('display', 'flex');
                if (category == 'scribble') {
                    $('#lightbox .lightbox-content').width('400px');
                } else {
                    $('#lightbox .lightbox-content').width('auto');
                }
            },
            error: function(xhr, status, error) {
                console.log('AJAX Error:', status, error);
            },
            complete: function() {
                $('#matrixSpinner').hide(); // hide spinner
            }
        });
    });

    // close when pressing ESC key
    $(document).on('keydown', function(e) {
        if (e.key === "Escape") {
            $('#lightbox').fadeOut(200);
        }
    });

    // close lightbox (× or background)
    $('.lightbox-close, #lightbox').on('click', function(e) {
        if (e.target !== this) return; // only close if background or ×
        $('#lightbox').fadeOut(200);
    });
});