(function ($) {
    console.log('estoy listo para usarme');
    let animalplugin = (() => {
        const _init = () => {
            console.log(admin_url.ajax_url);
            $(`#showAllProducts`).click(function () {
                console.log($(this).attr(`data-isActive`))
                if ($(this).attr(`data-isActive`) !== `1`){
                    console.log(`estoy dentro`);
                    $(`#showAllProducts`).attr(`data-isActive`, `1`);
                } else {
                    $(`#showProductsPriority`).attr(`data-isActive`, `0`);
                }
            })
            $(`#showProductsPriority`).click(function () {
                $.ajax({
                    url: admin_url.ajax_url,
                    type: `get`,
                    data: {
                        action: `managerBackend2`
                    } 
                })
                .done(function (response){
                    console.log(response.response);
                });
            });
        };
        return {
            init: () => {
                _init();
            }
        }
    })();

    animalplugin.init();
})(jQuery);