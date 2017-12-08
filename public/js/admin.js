var imageSettingsPreview = $.extend({
    language: 'en',
    uploadAsync: true,
    maxFileSize: 5000,
    ajaxSettings: {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    },
    ajaxDeleteSettings: {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    },
    allowedFileTypes: ['image', 'swf'],
    //layoutTemplates: {footer: $('#image_upload_tmpl').html()},
    previewThumbTags: {
        'meta_title': '',
        'meta_alt': ''
    },
    overwriteInitial: false,
    browseClass: "btn btn-primary btn-block btn-top",
    showCaption: false,
    showRemove: false,
    showUpload: false

},  (typeof photo !== 'undefined') ? photo  : {});
$('.image-upload').fileinput(imageSettingsPreview);

$('#price').mask('000 000 000 000 000.00', {reverse: true});
$('#space').mask('000 000.00', {reverse: true});

jQuery.validator.addMethod("dateCompare", function(value, element) {
    // return this.optional(element) || (parseFloat(value) > 0);
    date_initial = $('#delivery_date_initial option:selected').val();
    year_initial = $('#delivery_year_initial option:selected').val();
    date_final = $('#delivery_date_final option:selected').val();
    year_final = $('#delivery_year_final option:selected').val();
    console.log(year_initial+''+date_initial);
    console.log(year_final+''+date_final);
    if (year_initial+''+date_initial <= year_final+''+date_final && date_initial != -1 && year_initial != -1 && date_final != -1 && year_final != -1){
        return true;
    } else {
        return false;
    }

}, "* delivery_date_final must be greater than delivery_date_initial");

jQuery.validator.addMethod("description", function (value, element) {
    console.log($('#my_editor_ifr').contents().find('body').text().trim().length);
    var content = $('#my_editor_ifr').contents().find('body').innerHTML;
    if($('#my_editor_ifr').contents().find('body').text().trim().length == 0)
    {
        return false;
    } else {
        return true;
    }
});

$.validator.addMethod("validateSlug", function(value, element)
{
    var inputElem = $('#slug'),
        data = { "emails" : inputElem.val() },
        eReport = ''; //error report
    var isSuccess = false;
    $.ajax(
        {
            beforeSend: function(request) {  // нужно для защиты от CSRF
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            type: "POST",
            async: false,
            url: '/admin/buildings/building/validate/'+$('#slug').val()+'/'+id,
            dataType: "json",
            data: data,
            success: function(data)
            {
                isSuccess = (data === true ? true : false)
            },
            error: function(xhr, textStatus, errorThrown)
            {
                alert('ajax loading error... ... '+url + query);
                return false;
            }
        });
    return isSuccess;

}, 'Slug must be unique');

$("form#building").validate({
    highlight : function(label) {
        $(label).closest('.form-group').addClass('has-error');
        if($(label).attr('id') == 'address') {
            $('a[href="#map"]').tab('show');
        }
    },
    unhighlight: function(label) {
        $(label).closest('.form-group').removeClass('has-error')
    },
    ignore : [],
    onfocusout: false,
    onkeyup: false,
    onclick: false,
    debug: true,
    // Specify validation rules
    rules: {
        delivery_year_final: {
            dateCompare: true
        },
        delivery_year_initial: {
            dateCompare: true
        },
        address: {
            required: true
        },
        forumUrl: {
            minlength: 3,
            required: true,
        },
        name: {
            required: true,
        },
        slug: {
            required: true,
            validateSlug: true,
        },
        description: {
            description: true,
        }

    },
    submitHandler: function(form) {
        form.submit();
    }
});




handlePlugins = function() {
    "use strict";
    if(typeof(wysihtml5) == "object")
        $('.wysiwyg').wysihtml5();
    if( $('#slug').val()=='undefined' || $('#slug').val()==null || $('#slug').val()=="" )
    {
        $('#name').transliterate();
    }
    // });
    // $('#title_ua').transliterate();
    $('.select-image').bind('click', function(e) {
        e.preventDefault();
        var target = $(this).data('target');
        $(target).trigger('click');
    })
    $('.datetimepicker').datetimepicker({
        locale: 'en'
    });
    $('.datepicker').datetimepicker({
        locale: 'en',
        viewMode: 'days',
        format: 'DD.MM.YYYY'
    });
    var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
    var elems1 = Array.prototype.slice.call(document.querySelectorAll('.switcheryred'));

    elems.forEach(function(html) {
        new Switchery(html, { color: '#5CB345', jackColor: '#ffffff' });
    });
    elems1.forEach(function(html) {
        new Switchery(html, { color: '#FF0000', jackColor: '#ffffff' });
    });

    $('#city_id').on('change', function () {
        var id = $(this).val();
        // console.log(id);

            $.ajax({
                url: "/admin/buildings/ajax-building-city/"+id,
                type: "POST",
                beforeSend: function(request) {  // нужно для защиты от CSRF
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function(data) {
                    $('#district_id').html('');
                    $('#district_id').removeAttr('disabled');
                    $('#company_builder').html('');
                    $('#company_builder').removeAttr('disabled');
                    $('#company_seller').html('');
                    $('#company_seller').removeAttr('disabled');
                    $('#subways').html('');
                    $('#subways').removeAttr('disabled');
                    $('#district_id').append('<option value="0">-</option>');
                    console.log(data['districts']);
                    $.each(data['districts'], function (index, val) {
                        $('#district_id')
                            .append('<option value="'+val['id']+'">'+val['name']+'</option>')
                    });
                    $.each(data['companies'], function (index, val) {
                        $('#company_builder')
                            .append('<option value="'+val['id']+'">'+val['name']+'</option>')
                        $('#company_seller')
                            .append('<option value="'+val['id']+'">'+val['name']+'</option>')
                    });
                    $.each(data['subways'], function (index, val) {
                        $('#subways')
                            .append('<option value="'+val['id']+'">'+val['name']+'</option>')
                    });
                    // $('#ajax-news').append(html).show('slow');

                }
            });
    });

    $(".tagit").tagit();
    var fileinputSettingsMultiple = $.extend({
        language: 'en',
        uploadAsync: true,
        maxFileSize: 5000,
        ajaxSettings: {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        ajaxDeleteSettings: {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        allowedFileTypes: ['image', 'swf'],
        //layoutTemplates: {footer: $('#image_upload_tmpl').html()},
        previewThumbTags: {
            'meta_title': '',
            'meta_alt': ''
        },
        overwriteInitial: false,
        uploadExtraData: function(previewId) {
            var out = {};
            $('#' + previewId + ' input').each(function() {
                var $el = $(this);
                out[$el.attr('name')] = $el.val();
            });
            return out;
        }
    },  (typeof gallery !== 'undefined') ? gallery  : {});
    $('.company-gallery-upload').fileinput(fileinputSettingsMultiple);
    $('.building-gallery-upload').fileinput(fileinputSettingsMultiple);


    var footerTemplate = '<div class="file-thumbnail-footer" style ="height:50px">\n' +
        '   <div style="margin:5px 0">\n' +
        '       <input class="kv-input kv-new form-control input-sm text-center {TAG_CSS_NEW}" value="{caption}" placeholder="Enter caption...">\n' +
        '   </div>\n' +
        '   {size} {actions}\n' +
        '</div>';

    var fileinputSettingsFile = $.extend({
        language: 'en',
        uploadAsync: true,
        maxFileSize: 24000,
        previewFileIcon: '<i class="fa fa-file"></i>',
        ajaxSettings: {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        ajaxDeleteSettings: {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        //layoutTemplates: {footer: $('#image_upload_tmpl').html()},
        layoutTemplates: {footer: footerTemplate},
        initialPreviewFileType: ['image', 'text'],
        overwriteInitial: true,
        previewFileIconSettings: { // configure your icon file extensions
            'doc': '<i class="fa fa-file-word-o text-primary"></i>',
            'xls': '<i class="fa fa-file-excel-o text-success"></i>',
            'ppt': '<i class="fa fa-file-powerpoint-o text-danger"></i>',
            'pdf': '<i class="fa fa-file-pdf-o text-danger"></i>',
            'zip': '<i class="fa fa-file-archive-o text-muted"></i>',
            'swf': '<i class="fa fa-home text-muted"></i>',
            'htm': '<i class="fa fa-file-code-o text-info"></i>',
            'txt': '<i class="fa fa-file-text-o text-info"></i>',
            'mov': '<i class="fa fa-file-movie-o text-warning"></i>',
            'mp3': '<i class="fa fa-file-audio-o text-warning"></i>',
            // note for these file types below no extension determination logic
            // has been configured (the keys itself will be used as extensions)
            'jpg': '<i class="fa fa-file-photo-o text-danger"></i>',
            'gif': '<i class="fa fa-file-photo-o text-muted"></i>',
            'png': '<i class="fa fa-file-photo-o text-primary"></i>'
        },
        uploadExtraData: function(previewId) {
            var out = {};
            $('#' + previewId + ' input').each(function() {
                console.log($(this));
                var $el = $(this);
                out[$el.attr('name')] = $el.val();
                console.log($el.val());

            });
            return out;
        }
    },  (typeof docs !== 'undefined') ? docs  : {});
    $('.company-file-upload').fileinput(fileinputSettingsFile);

    //var fileinputSettingsMultipleBaner = $.extend({
    //    language: 'ru',
    //    uploadAsync: true,
    //    maxFileSize: 5000,
    //    ajaxSettings: {
    //        headers: {
    //            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    //        }
    //    },
    //    ajaxDeleteSettings: {
    //        headers: {
    //            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    //        }
    //    },
    //    allowedFileTypes: ['image'],
    //    //layoutTemplates: {footer: $('#image_upload_tmpl').html()},
    //    previewThumbTags: {
    //        'meta_title': '',
    //        'meta_alt': ''
    //    },
    //    overwriteInitial: false,
    //    uploadExtraData: function(previewId) {
    //        var out = {};
    //        $('#' + previewId + ' input').each(function() {
    //            var $el = $(this);
    //            out[$el.attr('name')] = $el.val();
    //        });
    //        return out;
    //    }
    //},  (typeof baner !== 'undefined') ? baner  : {});
    //
    //$('.product-category-gallery-upload').fileinput(fileinputSettingsMultipleBaner);

    var imageSettingsPreview = $.extend({
        language: 'en',
        uploadAsync: true,
        maxFileSize: 5000,
        ajaxSettings: {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        ajaxDeleteSettings: {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        allowedFileTypes: ['image', 'swf'],
        //layoutTemplates: {footer: $('#image_upload_tmpl').html()},
        previewThumbTags: {
            'meta_title': '',
            'meta_alt': ''
        },
        overwriteInitial: false,
        browseClass: "btn btn-primary btn-block",
        showCaption: false,
        showRemove: false,
        showUpload: false

    },  (typeof photo !== 'undefined') ? photo  : {});
    $('.image-upload').fileinput(imageSettingsPreview);

    $('.rating').raty({
        half: true,
        readOnly: true,
        score: function() {
            return $(this).attr('data-score');
        }
    });

    // Init the font icon picker
    var iconPicker = $('.icon-picker').fontIconPicker({
        theme: 'fip-bootstrap'
    });

    $.ajax({
        url: '/icons.json',
        type: 'GET',
        dataType: 'json'
    }).done(function(response) {
        var iconsList = [];

        // Push the fonts into the array
        $.each(response, function(i, v) {
            iconsList.push( 'fa ' + i );
        });
        iconPicker.setIcons(iconsList);

    });

},

    handleUploadImagePreview = function() {
        "use strict";
        $('.upload-image').change(function () {
            var target = $(this).data('target');
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(target).attr('src', e.target.result);
                };
                reader.readAsDataURL(this.files[0]);
            }
        });


    }
handleDataTableDefault = function() {
    "use strict";
    if ($(".table-list").length !== 0) {
        var table = $(".table-list").DataTable({
            "processing": true
        })

    }

    if ($(".table-logs").length !== 0) {
        var table = $(".table-logs").DataTable({
            "processing": true,

            "rowCallback": function( row, data, index ) {
                // console.log(data);
                if ( data[3] == "" && data[4] == "" )
                {
                    $('td', row).css('background-color', '#fd9a9a');
                }
                else
                {
                    $('td', row).css('background-color', '#9afda2');
                }
            },
            "order": [[ 5, "desc" ]]
        })

    }
    $('#city').on('change', function() {
        var city = $('#city').val();
        var company = $('#company').val();
            location.href = '/admin/buildings/filter/'+city+'/'+company
    })
    $('#company').on('change', function() {
        var city = $('#city').val();
        var company = $('#company').val();
        console.log(city);
            location.href = '/admin/buildings/filter/'+city+'/'+company

    })
    $('#city_companies').on('change', function() {
        var city = $('#city_companies').val();
        var type = $('#type').val();
        location.href = '/admin/companies/filter/'+city
    })
    $('#city_agent').on('change', function() {
        var city = $('#city_agent').val();
        var type = $('#type_agent').val();
        console.log(type);
        location.href = '/admin/agents/filter/'+city+'/'+type
    })
    $('#type_agent').on('change', function() {
        var city = $('#city_agent').val();
        var type = $('#type_agent').val();
        console.log(type);
        location.href = '/admin/agents/filter/'+city+'/'+type
    })

},
    handlePanelAction = function() {
        "use strict";
        $("[data-click=panel-remove]").hover(function() {
            $(this).tooltip({
                title: "Remove",
                placement: "bottom",
                trigger: "hover",
                container: "body"
            }), $(this).tooltip("show")
        }), $("[data-click=panel-remove]").click(function(e) {
            e.preventDefault(), $(this).tooltip("destroy"), $(this).closest(".panel").remove()
        }), $("[data-click=panel-collapse]").hover(function() {
            $(this).tooltip({
                title: "Collapse / Expand",
                placement: "bottom",
                trigger: "hover",
                container: "body"
            }), $(this).tooltip("show")
        }), $("[data-click=panel-collapse]").click(function(e) {
            e.preventDefault(), $(this).closest(".panel").find(".panel-body").slideToggle()
        }), $("[data-click=panel-reload]").hover(function() {
            $(this).tooltip({
                title: "Reload",
                placement: "bottom",
                trigger: "hover",
                container: "body"
            }), $(this).tooltip("show")
        }), $("[data-click=panel-reload]").click(function(e) {
            e.preventDefault();
            var a = $(this).closest(".panel");
            if (!$(a).hasClass("panel-loading")) {
                var t = $(a).find(".panel-body"),
                    i = '<div class="panel-loader"><span class="spinner-small"></span></div>';
                $(a).addClass("panel-loading"), $(t).prepend(i), setTimeout(function() {
                    $(a).removeClass("panel-loading"), $(a).find(".panel-loader").remove()
                }, 2e3)
            }
        }), $("[data-click=panel-expand]").hover(function() {
            $(this).tooltip({
                title: "Expand / Compress",
                placement: "bottom",
                trigger: "hover",
                container: "body"
            }), $(this).tooltip("show")
        }), $("[data-click=panel-expand]").click(function(e) {
            e.preventDefault();
            var a = $(this).closest(".panel"),
                t = $(a).find(".panel-body"),
                i = 40;
            if (0 !== $(t).length) {
                var l = $(a).offset().top,
                    n = $(t).offset().top;
                i = n - l
            }
            if ($("body").hasClass("panel-expand") && $(a).hasClass("panel-expand")) $("body, .panel").removeClass("panel-expand"), $(".panel").removeAttr("style"), $(t).removeAttr("style");
            else if ($("body").addClass("panel-expand"), $(this).closest(".panel").addClass("panel-expand"), 0 !== $(t).length && 40 != i) {
                var s = 40;
                $(a).find(" > *").each(function() {
                    var e = $(this).attr("class");
                    "panel-heading" != e && "panel-body" != e && (s += $(this).height() + 30)
                }), 40 != s && $(t).css("top", s + "px")
            }
            $(window).trigger("resize")
        })
    },
    handlePageContentView = function() {
        "use strict";
        $.when($("#page-loader").addClass("hide")).done(function() {
            $("#page-container").addClass("in")
        })
    },
    handleScrollToTopButton = function() {
        "use strict";
        $(document).scroll(function() {
            var e = $(document).scrollTop();
            e >= 200 ? $("[data-click=scroll-top]").addClass("in") : $("[data-click=scroll-top]").removeClass("in")
        }), $("[data-click=scroll-top]").click(function(e) {
            e.preventDefault(), $("html, body").animate({
                scrollTop: $("body").offset().top
            }, 500)
        })
    },

    App = function() {
        "use strict";
        return {
            init: function() {
                handlePanelAction(), handleDataTableDefault(), handleUploadImagePreview(), handlePlugins(), handlePageContentView(), handleScrollToTopButton()/* handleDraggablePanel(), handleLocalStorage(), handleResetLocalStorage(),*/
            }
        }
    }();