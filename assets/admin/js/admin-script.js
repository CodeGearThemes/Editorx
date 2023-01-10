(function(){
	'use strict';

	window.addEventListener('load', function(){
        const buttonElement = document.getElementById('starter-install');
        if( buttonElement ){
            buttonElement.addEventListener('click', (e) => {
                if( buttonElement.dataset.status == 'active' )
                    return;
                e.preventDefault();

                buttonElement.innerHTML = '<i class="dashicons dashicons-update-alt rotating"></i> Installing…';

                const formData = new FormData();
                formData.append( 'action', 'editorx_install_starter_plugin' );
                formData.append( 'nonce', editorx_localize.nonce );


                fetch( editorx_localize.ajax_url, {
                    method: "POST",
                    credentials: 'same-origin',
                    body: formData
                })
                .then((response) => response.json())
                .then((data) => {

                    if( data.success ){
                        buttonElement.innerHTML = '<i class="dashicons dashicons-saved"></i> Activated';

                        setTimeout( function() {
                            buttonElement.innerHTML = 'Redirecting…';

                            setTimeout( function() {

                                window.location = buttonElement.getAttribute('href');

                            }, 1000 );
                        }, 500 );
                    }


                })
                .catch((error) => {
                    output.innerHTML = '<span>'+Codegear_Starter_localize.failed_message+'</span>';
                });

            });
        }
    })

})();
