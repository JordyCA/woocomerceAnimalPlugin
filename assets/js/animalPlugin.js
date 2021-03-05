(function ($) {
    let animalplugin = (() => {
        const _init = () => {
            $(`#showAllProducts`).prop( "checked", true);
            $(`#showAllProducts`).click(function () {
                $(`.animal-select-group`).hide();
                $.ajax({
                    url: admin_url.ajax_url,
                    type: `get`,
                    data: {
                        action: `managerBackend2`,
                        isAllRecords: '1',
                        animal: ""
                    } 
                })
                .done(function (response){
                    $(`.content-products`).html(``);
                    $(`.content-products`).html(response.response);
                });
            })
            $(`#showProductsPriority`).click(function () {
                $(`.animal-select-group`).show();
                $(`.animal-select`).prop( "checked", false);
            });
            $(`.animal-select`).click(function () {
                $.ajax({
                    url: admin_url.ajax_url,
                    type: `get`,
                    data: {
                        action: `managerBackend2`,
                        isAllRecords: '0',
                        animal: $(this).val()
                    } 
                }) .done(function (response){
                    $(`.content-products`).html(``);
                    $(`.content-products`).html(response.response);
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