$.cookie.json = true;
$.cookie.defaults.path = '/';

$(function()
{
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        let $tab = $(this)
            , $group = $tab.data('group');
        if ($group) setCookie($group, $tab.attr('href'));
    });

    $.each(getCookie(null), function(cookie) {
        $('a[href="'+ getCookie(cookie)+'"]').tab('show');
    });

    $('canvas.sprite').each(function(i, sprite)
    {
        let $sprite = $(sprite)
            , w = $sprite.attr('width')
            , h = $sprite.attr('height')
            , x = $sprite.data('x')
            , y = $sprite.data('y')
            , src = $sprite.data('src')
            , ctx = $sprite[0].getContext('2d')
            , img = new Image();

        img.onload = function() {
            ctx.drawImage(img, x, y, w, h, 0, 0, w, h);
        };
        img.src = src;
    });

    $('[data-toggle="popover"]').popover({
        container: 'body',
        placement: 'top',
        trigger: 'hover'
    });
});

$(document).click(function (event) {
    const clickover = $(event.target);
    let $navbar = $(".navbar-collapse");
    let _opened = $navbar.hasClass("in");
    if (_opened === true && !clickover.hasClass("form-control")) {
        $navbar.collapse('hide');
    }
});

function setCookie(key, value) {
    if (typeof(Storage) !== "undefined") {
        localStorage.setItem('t'+key, value);
    } else {
        $.cookie('t'+key, value);
    }
}

function getCookie(key) {
    if (key === null) {
        if (typeof(Storage) !== "undefined") {
            return allStorage();
        } else {
            return $.cookie();
        }
    } else {
        if (typeof(Storage) !== "undefined") {
            return localStorage.getItem(key);
        } else {
            return $.cookie(key);
        }
    }
}

function allStorage() {
    let i = 0,
        oJson = {},
        sKey;
    for (; sKey = window.localStorage.key(i); i++) {
        if (sKey.length < 5) {
            oJson[sKey] = window.localStorage.getItem(sKey);
        }
    }

    return oJson;
}