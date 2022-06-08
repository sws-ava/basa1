// search companies catalog
$(document).ready(function() {



    if ($(".closeSearchBlock").length) {
        $(".closeSearchBlock").click(function() {

            var someTabTriggerEl = document.querySelector('#pills-home-tab')
            var tab = new bootstrap.Tab(someTabTriggerEl)

            tab.show()

        });

    }


    $(".showGal").click(function() {
        $(".slider").slick('reinit');
    });

    if ($(".chips").length) {
        if (location.search === '?district_id=0&name=&inn=&ogrn=&text=') {
            $('.chips').addClass('d-none');
        }
    }

    if ($(".sendFeedback").length) {
        $(".formName").keyup(function() {
            $('.formName').css("border-color", "#c4dee3")
        })
        $(".formText").keyup(function() {
            $('.formText').css("border-color", "#c4dee3")
        })
        $(".formMail").keyup(function() {
            $('.formMail').css("border-color", "#c4dee3")
        })


        $(".sendMail").click(function(e) {
            e.preventDefault()
            let formName = $('.formName').val()
            if (formName == '') {
                $('.formName').css("border-color", "red")
            }

            let formMail = $('.formMail').val()
            if (formMail == '') {
                $('.formMail').css("border-color", "red")
            }
            let formText = $('.formText').val()

            if (formText == '') {
                $('.formText').css("border-color", "red")
            }

            if (formName != '' && formText != '') {
                jQuery.ajax({
                    url: '/api/mailFromAbout',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    data: {
                        formName,
                        formMail,
                        formText
                    },
                    method: 'POST'
                }).done(function(request) {
                    if (request) {
                        console.log(request);

                        $('.formName').val('')
                        $('.formMail').val('')
                        $('.formText').val('')

                        var myModal = new bootstrap.Modal(document.getElementById('formModal'), {
                            keyboard: false
                        })


                        myModal.show()
                    }
                })
            }


        });
    }




    if ($('.isEmptyUl').length) {
        for (j = 0; j < 7; j++) {
            let ulArray = document.getElementsByClassName("isEmptyUl")
            for (i = 0; i < ulArray.length; i++) {
                let length = ulArray[i].getElementsByTagName('li').length
                if (length === 1) {
                    ulArray[i].remove()
                }
            }
        }
    }


    if ($('#defaultSearchInput').length) {

        $("#defaultSearchInput").keyup(function() {
            var numChars = $(this).val().length;
            if (numChars >= 3) {
                var queryString = $(this).val();
                jQuery.ajax({
                    url: '/api/defaultSearch',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    data: {
                        queryString
                    },
                    method: 'POST'
                }).done(function(data) {

                    comapnies = data.companies
                    if (comapnies.length) {
                        let comapniesNewArr = `
                            <li class="head mt-2">
                                Компании
                            </li>
                    `
                        for (let i = 0; i < comapnies.length; i++) {
                            comapniesNewArr += `
                                <li>
                                    <a href="/company/${comapnies[i].id}">${comapnies[i].name}
                                    <span class="d-block d-md-inline">${comapnies[i].districtName} ${comapnies[i].cityName}</span></a>
                                </li>`
                        }
                        const tBody = document.querySelector('.searchListHolderCompanies')
                        tBody.innerHTML = ''
                        tBody.insertAdjacentHTML('afterbegin', comapniesNewArr)
                    } else {
                        $('.searchListHolderCompanies li').remove()
                    }



                    // cities = data.cities
                    // if (cities.length) {
                    //     let citiesNewArr = `
                    //         <li class="head">
                    //             Города
                    //         </li>
                    // `
                    //     for (let i = 0; i < cities.length; i++) {
                    //         citiesNewArr += `
                    //             <li>
                    //                 <a class="chipsLink" param="city_id---${cities[i].id}" href="#">${cities[i].name}</a>
                    //             </li>`
                    //     }
                    //     const tBody = document.querySelector('.searchListHolderСities')
                    //     tBody.innerHTML = ''
                    //     tBody.insertAdjacentHTML('afterbegin', citiesNewArr)
                    // } else {
                    //     $('.searchListHolderСities li').remove()
                    // }


                    work_cities = data.work_cities
                    if (work_cities.length) {
                        let work_citiesNewArr = `
                            <li class="head">
                                Города
                            </li>
                    `
                        for (let i = 0; i < work_cities.length; i++) {
                            work_citiesNewArr += `
                                <li>
                                    <a class="chipsLink" param="work_cities---${work_cities[i].id}" href="#">${work_cities[i].name}</a>
                                </li>`
                        }
                        const tBody = document.querySelector('.searchListHolderWorkСities')
                        tBody.innerHTML = ''
                        tBody.insertAdjacentHTML('afterbegin', work_citiesNewArr)
                    } else {
                        $('.searchListHolderWorkСities li').remove()
                    }

                    work_regions = data.work_regions
                    if (work_regions.length) {
                        let work_regionsNewArr = `
                            <li class="head">
                                Области
                            </li>
                    `
                        for (let i = 0; i < work_regions.length; i++) {
                            work_regionsNewArr += `
                                <li>
                                    <a class="chipsLink" param="work_regions---${work_regions[i].id}" href="#">${work_regions[i].name}</a>
                                </li>`
                        }
                        console.log(work_regionsNewArr);
                        const tBody = document.querySelector('.searchListHolderWorkRegions')
                        tBody.innerHTML = ''
                        tBody.insertAdjacentHTML('afterbegin', work_regionsNewArr)
                    } else {
                        $('.searchListHolderWorkRegions li').remove()
                    }


                    // work_regions


                    // regions = data.regions
                    // if (regions.length) {
                    //     let regionsNewArr = `
                    //         <li class="head">
                    //             Области
                    //         </li>
                    // `
                    //     for (let i = 0; i < regions.length; i++) {
                    //         regionsNewArr += `
                    //             <li>
                    //                 <a href="/?district_id=${regions[i].id}">${regions[i].name}</a>
                    //             </li>`
                    //     }
                    //     const tBody = document.querySelector('.searchListHolderRegions')
                    //     tBody.innerHTML = ''
                    //     tBody.insertAdjacentHTML('afterbegin', regionsNewArr)
                    // } else {
                    //     $('.searchListHolderRegions li').remove()
                    // }

                    heads = data.heads
                    if (heads.length) {
                        let headsNewArr = `
                            <li class="head mt-2">
                                Руководители
                            </li>
                    `
                        for (let i = 0; i < heads.length; i++) {
                            let heads_first_name = heads[i].heads_first_name
                            let heads_second_name = heads[i].heads_second_name
                            let heads_last_name = heads[i].heads_last_name

                            if (heads[i].heads_first_name == null) {
                                heads_first_name = ''
                            }
                            if (heads[i].heads_second_name == null) {
                                heads_second_name = ''
                            }
                            if (heads[i].heads_last_name == null) {
                                heads_last_name = ''
                            }


                            headsNewArr += `
                                <li>
                                    <a href="/company/${heads[i].heads_company_id}">
                                    ${heads_first_name} ${heads_second_name} ${heads_last_name}
                                    <br>
                                    <span class="d-block d-md-inline">${heads[i].name} </span>
                                    <br>
                                    <span class="d-block d-md-inline">${heads[i].districtName}, ${heads[i].cityName}</span></a>
                                    </a>
                                </li>`
                        }
                        const tBody = document.querySelector('.searchListHolderHeads')
                        tBody.innerHTML = ''
                        tBody.insertAdjacentHTML('afterbegin', headsNewArr)
                    } else {
                        $('.searchListHolderHeads li').remove()
                    }


                    field_works = data.field_works
                    if (field_works.length) {
                        let field_worksNewArr = `
                            <li class="head">
                                Полевые работы
                            </li>
                    `
                        for (let i = 0; i < field_works.length; i++) {
                            field_worksNewArr += `
                                <li>
                                    <a href="" class="chipsLink" param="field_works---${field_works[i].field_works_item_id}" >${field_works[i].field_works_item_name}</a>
                                </li>`
                        }
                        const tBody = document.querySelector('.searchListHolderField_works')
                        tBody.innerHTML = ''
                        tBody.insertAdjacentHTML('afterbegin', field_worksNewArr)
                    } else {
                        $('.searchListHolderField_works li').remove()
                    }

                    res_solutions = data.res_solutions
                    if (res_solutions.length) {
                        let res_solutionsNewArr = `
                            <li class="head">
                                Решения для рисерча
                            </li>
                    `
                        for (let i = 0; i < res_solutions.length; i++) {
                            res_solutionsNewArr += `
                                <li>
                                    <a class="chipsLink" param="res_solutions---${res_solutions[i].research_solutions_items_id}" href="">${res_solutions[i].research_solutions_items_name}</a>
                                </li>`
                        }
                        const tBody = document.querySelector('.searchListHolderRes_solutions')
                        tBody.innerHTML = ''
                        tBody.insertAdjacentHTML('afterbegin', res_solutionsNewArr)
                    } else {
                        $('.searchListHolderRes_solutions li').remove()
                    }

                    spec = data.spec
                    if (spec.length) {
                        let specNewArr = `
                            <li class="head">
                                Специализации
                            </li>
                    `
                        for (let i = 0; i < spec.length; i++) {
                            specNewArr += `
                                <li>
                                    <a class="chipsLink" param="spec---${spec[i].spec_item_id}" href="">${spec[i].spec_item_name}</a>
                                </li>`
                        }
                        const tBody = document.querySelector('.searchListHolderSpec')
                        tBody.innerHTML = ''
                        tBody.insertAdjacentHTML('afterbegin', specNewArr)
                    } else {
                        $('.searchListHolderSpec li').remove()
                    }

                    resources = data.resources
                    if (resources.length) {
                        let resourcesNewArr = `
                            <li class="head">
                                Ресурсы
                            </li>
                    `
                        for (let i = 0; i < resources.length; i++) {
                            resourcesNewArr += `
                                <li>
                                    <a class="chipsLink" param="resources---${resources[i].resources_items_id}" href="">${resources[i].resources_items_name}</a>
                                </li>`
                        }
                        const tBody = document.querySelector('.searchListHolderResources')
                        tBody.innerHTML = ''
                        tBody.insertAdjacentHTML('afterbegin', resourcesNewArr)
                    } else {
                        $('.searchListHolderResources li').remove()
                    }


                });
            } else if (numChars == 0) {
                $('.searchListHolderCompanies li').remove()
                    // $('.searchListHolderRegions li').remove()
                $('.searchListHolderСities li').remove()
                $('.searchListHolderWorkСities li').remove()
                $('.searchListHolderWorkRegions li').remove()
                $('.searchListHolderHeads li').remove()
                $('.searchListHolderRes_solutions li').remove()
                $('.searchListHolderField_works li').remove()
                $('.searchListHolderSpec li').remove()
                $('.searchListHolderResources li').remove()
            }
        });

    }
    if ($('.chipsItems').length) {
        $(".delFilterItem").click(function() {
            let param = this.closest('.imgHolder').getAttribute('param')
                // console.log(param);
            let newUrl = ''
            location.queryString = {};
            location.search.substr(1).split("&").forEach(function(pair) {
                if (pair === "") return;
                var parts = pair.split("=");
                paramArr = param.split("---")
                let param_name = paramArr[0] // city_id
                let param_val = paramArr[1] // 366
                if ([parts[0]] != param_name) {
                    newUrl += parts[0] + '=' + parts[1] + '&'
                } else {
                    let itemsIn = parts[1].split(",")
                    let newItemsStack = ''
                    if (itemsIn.length > 1) {

                        itemsIn.forEach(function(val) {

                            if (val != param_val) {
                                newItemsStack += val + ','
                            }

                            // console.log(param_val);
                            // console.log(param_val.length)
                        })
                        newUrl += parts[0] + '=' + newItemsStack.substring(0, newItemsStack.length - 1) + '&'
                    }

                }
            });
            newUrl = '?' + newUrl.substring(0, newUrl.length - 1)
            window.location.href = newUrl


        })
    }

});


$(document).on('click', '.chipsLink', function(e) {
    e.preventDefault();
    let param = this.getAttribute('param').split("---")
    let param_name = param[0]
    let param_val = param[1]
    let isNewParam = false


    let newUrl = ''
    if (location.search != '') {
        location.search.substr(1).split("&").forEach(function(pair) {
            var parts = pair.split("=");
            if ([parts[0]] != param_name) {
                newUrl += parts[0] + '=' + parts[1] + '&'
            } else {
                isNewParam = true
                partsArr = parts[1].split(",")
                let isNewParamValue = false
                if (partsArr.length) {
                    partsArr.forEach(function(item) {
                        if (item == param_val) {
                            isNewParamValue = true
                        }
                    })
                }
                if (isNewParamValue == false) {
                    newUrl += parts[0] + '=' + parts[1] + ',' + param_val + '&'
                } else {
                    newUrl += parts[0] + '=' + parts[1] + '&'
                }
            }
        });
    }
    if (isNewParam == false) {
        newUrl += param_name + '=' + param_val + '&'
    }
    newUrl = '?' + newUrl.substring(0, newUrl.length - 1)
    window.location.href = newUrl
});