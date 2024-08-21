//== Class definition
var SweetAlert2Demo = (function () {
    //== Demos
    var initDemos = function () {

        $("#alert_demo_3_3").click(function (e) {
            swal("Berhasil", "Produk baru telah ditambahkan", {
                icon: "success",
                buttons: {
                    confirm: {
                    className: "btn btn-success",
                    },
                },
            });
        });

    };

    return {
        //== Init
        init: function () {
            initDemos();
        },
    };
})();

//== Class Initialization
jQuery(document).ready(function () {
    SweetAlert2Demo.init();
});