$(function() {

    act_php_dir = "../act-php.php";
    $('.php-code').each(function(index) {
        var txt = $(this).text();
        $(this).load(act_php_dir, {
            "type": "phpCode",
            "code": txt
        })
    })

    root = ask("rootDir");
    root_phy = ask("rootPhyDir");
    loginStatus = ask("loginStatus"); // 用户名
    accessRight = ask("accessRight");

    checkLogin(loginStatus);

    $("a[data-rel='root']").each(function(index) {
        var a = $(this).attr('href');
        $(this).attr('href', root + a);
    })
    if (accessRight == 0) {
        $("[data-rel='import']").css("display", "none").find("a").attr("href", "#");
    }
})
$(document).on({
    click: function() {
        $(this).toggleClass("selected");
    }
}, ".btn.self")

function ask(x) {
    var back = "";
    $.ajax({
        async: false,
        type: "post",
        url: act_php_dir,
        data: {
            "type": x
        },
        success: function(e) {
            back = e;
        }
    })
    return back;
}

function checkLogin(loginStatus) {
    if (loginStatus == "") {
        var block = "<li class=\"right\"><a data-rel=\"root\"  href=\"login.php\">登陆</a></li> <li class=\"right\"><a data-rel=\"root\"  href=\"login.php\" target=\"blank\">注册</a></li>";
    } else {
        var imp = (accessRight > 0) ? "<li class=\"hover\" data-rel='import'><a data-rel=\"root\"  href=\"import.php\" target=\"blank\">投稿</a></li>" : "";
        var man = (accessRight > 1) ? "<li class=\"hover\" data-rel='manage'><a data-rel=\"root\"  href=\"manage.php\" target=\"blank\">管理</a></li>" : ""
        var block = "<li class=\"username right\"><a href=''>" + loginStatus + "</a></li>" + "<ul>" + "<li class=\"hover\"><a data-rel=\"root\"  href=\"act-account.php?out=0\">退出登录</a></li>" + imp + man + "</ul>" + "<li class=\"username right\"><a data-rel=\"root\"  href=\"about.php\">欢迎您！</a></li>";
    }
    $(".global-nav ul").append(block);
}
