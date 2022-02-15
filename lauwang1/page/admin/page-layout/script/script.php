<script>
    // const $ = document.querySelector.bind(document);
    // const $$ = document.querySelectorAll.bind(document);
</script>
<!-- <script src="./handle.js"></script> -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    // jQuery('#thucDonNode').summernote({
    //     height: 300
    // });
</script>
<script src="./js/Library.js"></script>
<script>
    smoothSroll({
        ClassName: "smoothJS"
    });

    window.onscroll = function () {
        const $$ = document.querySelectorAll.bind(document);
        const $ = document.querySelector.bind(document);
        // lấy cái độ dài mảng
        let item = $$('.Category__right-item').length;
        for(let i=0;i<item;i++) {
            let Element = $$('.Category__right-item')[i];
            let PostionTop = (Element.offsetTop)-100;
            let ID = Element.getAttribute('data');
            let MaxPostionTop = (PostionTop + (Element.offsetHeight))

            if(window.pageYOffset>=PostionTop&&window.pageYOffset<=MaxPostionTop) {
                $('.smoothJS.active_nav').classList.remove('active_nav');
                $(`.smoothJS[data-scroll="${ID}"]`).classList.add('active_nav');
                break;
            }
        }        
    }

    // clear url ảo tránh lãng phí bộ nhớ
    let fileMenu = document.querySelector('#fileMenu');
    let imgfile = document.querySelector('#imgFile');
    fileMenu.onchange = function (e) {
        let file = e.target.files[0];
        let srcImg = URL.createObjectURL(file);

        imgfile.src = srcImg;
        function validateFrom (srcImg) {
           let fileElement =  fileMenu;
           URL.revokeObjectURL(srcImg);
        }
    }

    function Click(e) {
        let msg = '';
        if(e.name == 'add') {
            msg = 'Bạn có chắc chắn muốn duyệt không!!!';
        } else {
            msg = 'Bạn có chắc chắn muốn xóa không!!!';
        }
        let result = confirm(msg);
        return result;
    }

    function Update(e) {
        let className = '#'+e.name;
        let Element = jQuery(className);

        if(e.value == 'Sửa') {
            let parentElement = Parent(e,'.menuJS');
            // Lấy cái giá trị
            let ID = parentElement.getAttribute('data');

            $.ajax({
                url: './index.php',
                method: 'GET',
                data: {
                    ID: ID
                }
            })

        }

        jQuery('html,body').animate({
            scrollTop: (Element.offset().top)-100,
        },300)

        return false;
    }


    function Parent(element,select) {
        while(element.parentElement) {
            if(element.parentElement.matches(select)) {
                return element.parentElement;
            }
            element = element.parentElement;
        }
    }

</script>