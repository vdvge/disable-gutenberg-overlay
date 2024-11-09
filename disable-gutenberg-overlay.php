<?php
/*
Plugin Name: Disable Gutenberg Overlay
Description: Deactivates the “Choose a pattern” overlay in the Gutenberg editor.
Version: 1.0
Author: Boris Wallbruch
*/

function disable_gutenberg_pattern_overlay() {
    // Removes Block-Patterns
    remove_theme_support('core-block-patterns');

     // Add custom CSS to hide the overlay specifically
    echo '<style>
        .components-modal__screen-overlay {
            display: none !important;
        }
    </style>';
    
    // Add JavaScript to close the overlay
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            const closeButtonSelector = ".components-modal__header button[aria-label=\'Close\']";
            const overlayObserver = new MutationObserver((mutations) => {
                mutations.forEach((mutation) => {
                    if (mutation.type === "childList") {
                        const closeButton = document.querySelector(closeButtonSelector);
                        if (closeButton) {
                            closeButton.click(); 
                        }
                    }
                });
            });

            overlayObserver.observe(document.body, { childList: true, subtree: true });
        });
    </script>';
}
add_action('admin_head', 'disable_gutenberg_pattern_overlay');