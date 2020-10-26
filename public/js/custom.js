
function fillunits(){
    $.ajax({
        url: "/relatedunits",
        type: "GET",
        dataType: 'json',
        success: function (data) {
            var res=data;
            var select = document.getElementById("copyto");
            select.options.length=0;
            for(index in res) {
                for(i in res[index]) {
                    select.options[select.options.length] = new Option(res[index][i]['name'], res[index][i]['name']);
                }
            }

        },
        error: function (data) {
            console.log('Error:', data);
            $('#btn-save').html('Save Changes');
        }
    });
    $.ajax({
        url: "/allunits",
        type: "GET",
        dataType: 'json',
        success: function (data) {
            var res=data;
            console.log(data)
            var select = document.getElementById("reciever");
            select.options.length=0;
            for(index in res) {
                for(i in res[index]) {
                    select.options[select.options.length] = new Option(res[index][i]['name'], res[index][i]['name']);
                }
            }
            var select = document.getElementById("sender");
            select.options.length=0;
            for(index in res) {
                for(i in res[index]) {
                    select.options[select.options.length] = new Option(res[index][i]['name'], res[index][i]['name']);
                }
            }
        },
        error: function (data) {
            console.log('Error:', data);
            $('#btn-save').html('Save Changes');
        }
    });
}

$(document).ready(function() {
    $(".alert")
        .delay(1000)
        .fadeOut(1000);

    // image preview

    $(".image").change(function() {
        if (this.files && this.files[0]) {
            if(this.files[0].type=='application/pdf' || this.files[0].type.startsWith('image'))
            {
                var reader = new FileReader();
                reader.readAsDataURL(this.files[0]);

            }
            else {
                $(".image_display").attr("src", '/img_background/word.png');
                return;
            }

            reader.onload = function(e) {
                $(".image_display").attr("src", e.target.result);
            };

        }
    });

    // end image preview

    // radio button toggle

    $(".master").on("click", function() {
        $(".hidden_master").removeClass("hidden");
        $(".hidden_department").addClass("hidden");
        $(".hidden_branch").addClass("hidden");
    });

    $(".branch").on("click", function() {
        $(".hidden_department").addClass("hidden");
        $(".hidden_master").addClass("hidden");
        $(".hidden_branch").removeClass("hidden");
    });

    $(".department").on("click", function() {
        $(".hidden_branch").addClass("hidden");
        $(".hidden_master").addClass("hidden");
        $(".hidden_department")
            .removeClass("hidden")
            .fadeIn(2000);
    });

    $(".independent_branch_radio").on("click", function() {
        $(".hidden_independent_branch").removeClass("hidden");
        $(".hidden_branch").addClass("hidden");
    });
    $(".dependent_branch_radio").on("click", function() {
        $(".hidden_branch").removeClass("hidden");
        $(".hidden_independent_branch").addClass("hidden");
    });

    // data table for branches
    $("#branches_datatable").DataTable({
        "language": {
            "sProcessing":    "جاري التحميل...",
            "sLengthMenu":    "إظهار _MENU_ المدخلات",
            "sZeroRecords":   "لا يوجد سجلات مطابقة",
            "sEmptyTable":    "لا يوجد بيانات متاحة في الجدول",
            "sInfo":          "إظهار _START_ من _END_ اجمالي _TOTAL_ مدخلات",
            "sInfoEmpty":     "إظهار 0 to 0 of 0 المدخلات",
            "sInfoFiltered": '(مصفاه من _MAX_ جميع المدخلات)',
            "sInfoPostFix":   "",
            "sSearch":        'بحث:',
            "sUrl":           "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "جاري التحميل...",
            "oPaginate": {
                "sFirst":    "الأول",
                "sLast":    "الأخير",
                "sNext":    "التالى",
                "sPrevious": "السابق"
            },
            "oAria": {
                "sSortAscending":  ": تنشيط ليتم الترتيب تصاعدياً",
                "sSortDescending": ": تنشيط حتي يتم الترتيب تنازلي"
            }
        },
        "order":[[0,"desc"]]
});
});
