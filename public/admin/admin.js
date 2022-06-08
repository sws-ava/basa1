$(document).ready(function() {
    $(".nav-treeview .nav-link, .nav-link").each(function() {
        var location2 = window.location.protocol + '//' + window.location.host + window.location.pathname;
        var link = this.href;
        if (link == location2) {
            $(this).addClass('active');
            $(this).parent().parent().parent().addClass('menu-is-opening menu-open');

        }
    });

    if (window.location.pathname == '/administrator/all_companies') {
        $('.toAllCompanies').addClass('d-none')
    }

    $('.delete-btn').click(function() {
        var res = confirm('Подтвердите действия');
        if (!res) {
            return false;
        }
    });
})

// aa


tinymce.init({
    selector: '.editor',
    plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    toolbar_mode: 'floating',
    relative_urls: false,
    file_picker_callback: elFinderBrowser
});

function elFinderBrowser(callback, value, meta) {
    tinymce.activeEditor.windowManager.openUrl({
        title: 'File Manager',
        url: '/elfinder/tinymce5',
        /**
         * On message will be triggered by the child window
         *
         * @param dialogApi
         * @param details
         * @see https://www.tiny.cloud/docs/ui-components/urldialog/#configurationoptions
         */
        onMessage: function(dialogApi, details) {
            if (details.mceAction === 'fileSelected') {
                const file = details.data.file;

                // Make file info
                const info = file.name;

                // Provide file and text for the link dialog
                if (meta.filetype === 'file') {
                    callback(file.url, { text: info, title: info });
                }

                // Provide image and alt text for the image dialog
                if (meta.filetype === 'image') {
                    callback(file.url, { alt: info });
                }

                // Provide alternative source and posted for the media dialog
                if (meta.filetype === 'media') {
                    callback(file.url);
                }

                dialogApi.close();
            }
        }
    });
}


//add-remove photo row



$(document).ready(function() {
    if ($('#photoRows').length) {
        $('html').on('click', '.addPhotoInput', function() {
            // $('.addPhotoInput').click(function() {
            let rows = document.querySelector('#photoRows');
            let lastRow = Number(rows.lastElementChild.getAttribute('rowNum')) + 1
            console.log(lastRow);
            let photoRows = document.querySelector('#photoRows')
            newRow = `

            <div class="photoLine" rowNum="${lastRow}">
            <div class="form-group">
                <label for="">Описание фото</label>
                <input type="text" name="photos[${lastRow}][title]" class="form-control"
                    placeholder="Описание фото">
            </div>
            <div class="form-group">
                <input type="file" name="photos[${lastRow}][photo]" class="">
            </div>
            <div class="btn btn-block btn-danger delete-btn deleteRow mb-4"
                style=" width: max-content;   max-width: 180px; margin-left: auto;">
                <i class="fas fa-trash"></i>
            </div>

            <hr>
        </div>
            `
            photoRows.insertAdjacentHTML('beforeend', newRow);
        })
        $('html').on('click', '.deleteRow', function() {
            var res = confirm('Подтвердите действия');
            if (!res) {
                return false;
            }
            $(this).parent().remove();
        });
    }
});



// search companies admin page
$(document).ready(function() {

    if ($('#company_query').length) {



        $("#company_query").keyup(function() {
            var numChars = $(this).val().length;
            if (numChars >= 1) {
                var queryString = $(this).val();
                jQuery.ajax({
                    url: '/api/companySearch',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    data: {
                        queryString
                    },
                    method: 'POST'
                }).done(function(comapnies) {
                    let comapniesNewArr = []
                    for (let i = 0; i < comapnies.length; i++) {
                        if (comapnies[i].show == 0) {

                            comapniesNewArr += `
                            <tr>
                                <td> ${comapnies[i].id}</td>
                                <td> ${comapnies[i].name}</td>
                                <td>
                                <div class="d-flex align-items-center justify-content-end">
                                   <span class="mr-4" style="color: red; font-weight: 700;">Не
                                       показывается</span>
                                    <form method="POST" action="/administrator/show?${comapnies[i].id}">
                                    <input type="text" hidden name="company_id" value="${comapnies[i].id}">
                                    <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content} ">
                                    <input type="text" hidden="" name="show" value="1">
                                    <button type="submit" class="btn btn-block btn-success" style="    max-width: 180px; margin-left: auto;">
                                        Включить
                                    </button>
                                    </form>
                                </div>
                                </td>
                                <td>
                                </td><td>
                                    <a href="/administrator/company/${comapnies[i].id}" class="btn btn-block btn-warning" style="    max-width: 190px;">
                                        <i class="fas fa-pencil-alt mr-2"></i>
                                        Редактировать
                                    </a>
                                </td>
                            </tr>
                            `
                        } else if (comapnies[i].show == 1) {

                            comapniesNewArr += `
                            <tr>
                                <td> ${comapnies[i].id}</td>
                                <td> ${comapnies[i].name}</td>
                                <td>
                                <div class="d-flex align-items-center justify-content-end">
                                    <span class="mr-4" style="color: rgb(3, 127, 3); font-weight: 800;">Показывается</span>
                                    <form method="POST" action="/administrator/show?${comapnies[i].id}">
                                        <input type="text" hidden name="company_id" value="${comapnies[i].id}">
                                        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">
                                        <input type="text" hidden name="show" value="0">
                                        <button type="submit" class="btn btn-block btn-danger"
                                            style="    max-width: 180px; margin-left: auto;">
                                            Выключить
                                        </button>
                                    </form>
                                </div>
                                </td>
                                <td>
                                </td><td>
                                    <a href="/administrator/company/${comapnies[i].id}" class="btn btn-block btn-warning" style="    max-width: 190px;">
                                        <i class="fas fa-pencil-alt mr-2"></i>
                                        Редактировать
                                    </a>
                                </td>
                            </tr>
                            `
                        }
                    }
                    const tBody = document.querySelector('.searchList')
                    tBody.innerHTML = ''
                    tBody.insertAdjacentHTML('afterbegin', comapniesNewArr)
                });
            } else if (numChars == '') {
                jQuery.ajax({
                    url: '/api/companySearch',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    data: {
                        queryString
                    },
                    method: 'POST'
                }).done(function(comapnies) {
                    let comapniesNewArr = []
                        // for (let i = 0; i < comapnies.length; i++) {
                        //     if (comapnies[i].show == 0) {

                    //         comapniesNewArr += `
                    //         <tr>
                    //             <td> ${comapnies[i].id}</td>
                    //             <td> ${comapnies[i].name}</td>
                    //             <td>
                    //             <div class="d-flex align-items-center justify-content-end">
                    //                <span class="mr-4" style="color: red; font-weight: 700;">Не
                    //                    показывается</span>
                    //                 <form method="POST" action="/administrator/show?${comapnies[i].id}">
                    //                 <input type="text" hidden name="company_id" value="${comapnies[i].id}">
                    //                 <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">                                                        <input type="text" hidden="" name="company_id" value="14">
                    //                 <input type="text" hidden name="show" value="1">
                    //                 <button type="submit" class="btn btn-block btn-success" style="    max-width: 180px; margin-left: auto;">
                    //                     Включить
                    //                 </button>
                    //                 </form>
                    //             </div>
                    //             </td>
                    //             <td>
                    //             </td><td>
                    //                 <a href="/administrator/company/${comapnies[i].id}" class="btn btn-block btn-warning" style="    max-width: 190px;">
                    //                     <i class="fas fa-pencil-alt mr-2"></i>
                    //                     Редактировать
                    //                 </a>
                    //             </td>
                    //         </tr>
                    //         `
                    //     } else if (comapnies[i].show == 1) {

                    //         comapniesNewArr += `
                    //         <tr>
                    //             <td> ${comapnies[i].id}</td>
                    //             <td> ${comapnies[i].name}</td>
                    //             <td>
                    //             <div class="d-flex align-items-center justify-content-end">
                    //                 <span class="mr-4" style="color: rgb(3, 127, 3); font-weight: 800;">Показывается</span>
                    //                 <form method="POST" action="/administrator/show?${comapnies[i].id}">
                    //                     <input type="text" hidden name="company_id" value="${comapnies[i].id}">
                    //                     <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">
                    //                     <input type="text" hidden name="show" value="0">
                    //                     <button type="submit" class="btn btn-block btn-danger"
                    //                         style="    max-width: 180px; margin-left: auto;">
                    //                         Выключить
                    //                     </button>
                    //                 </form>
                    //             </div>
                    //             </td>
                    //             <td>
                    //             </td><td>
                    //                 <a href="/administrator/company/${comapnies[i].id}" class="btn btn-block btn-warning" style="    max-width: 190px;">
                    //                     <i class="fas fa-pencil-alt mr-2"></i>
                    //                     Редактировать
                    //                 </a>
                    //             </td>
                    //         </tr>
                    //         `
                    //     }
                    // }
                    const tBody = document.querySelector('.searchList')
                    tBody.innerHTML = ''
                    tBody.insertAdjacentHTML('afterbegin', comapniesNewArr)
                });
            }
        });

    }
});




// phone validation

$(document).ready(function() {
    if ($('.countrySelectMain').length) {
        $('.countrySelectMain').change(function() {

            let c = [{
                    "regions_id": "2",
                    "iso": "BY",
                    "phone_prefix": "+375",
                    "length": 15
                },
                {
                    "regions_id": "5",
                    "iso": "UA",
                    "phone_prefix": "+380",
                    "length": 13
                },
                {
                    "regions_id": "4",
                    "iso": "UZ",
                    "phone_prefix": "+998",
                    "length": 15
                },
                {
                    "regions_id": "3",
                    "iso": "KZ",
                    "phone_prefix": "+7",
                    "length": 15
                },
                {
                    "regions_id": "1",
                    "iso": "RU",
                    "phone_prefix": "+7",
                    "length": 12
                }
            ]
            for (let i = 0; i < c.length; i++) {
                if (c[i].regions_id == this.value) {
                    $('.phoneInput').val(c[i].phone_prefix)
                    $('.phoneInput').attr('maxlength', c[i].length)
                }
            }
        });
    }
});