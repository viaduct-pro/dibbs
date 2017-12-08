(function ($) {

    'use strict';

    var dictionary, methods;

    dictionary = {
        'А':'A',
        'а':'a',
        'Б':'B',
        'б':'b',
        'В':'V',
        'в':'v',
        'Г':'G',
        'г':'g',
        'Ґ':'G',
        'ґ':'g',
        'Д':'D',
        'д':'d',
        'Е':'E',
        'е':'e',
        'Ё':'E',
        'ё':'e',
        'Є':'Ye',
        'є':'ie',
        'Ж':'Zh',
        'ж':'zh',
        'З':'Z',
        'з':'z',
        'И':'I',
        'и':'i',
        'І':'I',
        'і':'i',
        'Ї':'Yi',
        'ї':'Y',
        'Й':'Y',
        'й':'y',
        'К':'K',
        'к':'k',
        'Л':'L',
        'л':'l',
        'М':'M',
        'м':'m',
        'Н':'N',
        'н':'n',
        'О':'O',
        'о':'o',
        'П':'P',
        'п':'p',
        'Р':'R',
        'р':'r',
        'С':'S',
        'с':'s',
        'Т':'T',
        'т':'t',
        'У':'U',
        'у':'u',
        'Ф':'F',
        'ф':'f',
        'Х':'Kh',
        'х':'kh',
        'Ц':'Ts',
        'ц':'ts',
        'Ч':'Ch',
        'ч':'ch',
        'Ш':'Sh',
        'ш':'sh',
        'Щ':'Shch',
        'щ':'shch',
        'Ы':'Y',
        'ы':'y',
        'Э':'E',
        'э':'e',
        'Ю':'Yu',
        'ю':'iu',
        'Я':'Ya',
        'я':'ia',
        'Ь': '',
        'ь': '',
        'Ъ': '',
        'ъ': '',
        '«': '',
        '»': '',
        '"': '',
        '№': '',
        ' ': '-',
    };

    methods = {
        translit: function (val) {
            var array = val.split('');
            var res = '';
            for(var i = 0; i < array.length; i++) {
                if(dictionary.hasOwnProperty(array[i])) {
                    res += dictionary[array[i]];
                } else if(/[a-z0-9]/.test(array[i])){
                    res += array[i];
                } else {
                    res += '';
                }

            }
            return res;
        }
    };

    $.fn.transliterate = function () {
        return this.each(function () {
            $(this).bind('change', function () {
                var value = $(this).val();
                var target = $(this).data('target');
                if(!target) return;
                $(target).val(methods.translit(value.toLowerCase()));
            });
        });
    };

}(jQuery));