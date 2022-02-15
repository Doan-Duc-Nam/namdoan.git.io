
function smoothSroll ({
    ClassName
}) {
    const $$ = document.querySelectorAll.bind(document);
    if($$(`.${ClassName}`)) {
        $$(`.${ClassName}`).forEach(e=>{
            e.onclick = function (e) {
                let ElementID = e.target.getAttribute('href');

                jQuery('html,body').animate({
                    scrollTop: (jQuery(ElementID).offset().top)-150,
                },300)

            }
        })
    }
}







