"use strict";

function slider (
    {
        parentSlider,
        loop = false,
        autoPlay = false,
        slideToShow=1,
        slideToScroll=1,
        slideDots=false,
        gap = 0,
        customPrev = '<button type="button" class="slider-arrow" aria-label="Previous" style="display: block;">Prev</button>',
        customNext = '<button type="button" class="slider-arrow" aria-label="Next" style="display: block;">Next</button>',
        enforcementTransition = 500,
        timeSpam=1300,
        // lưu ý khi autoPlay = true thì mới cần chuyền
        Duration=2000
    }
) {
    function removeAddEvent (elements,nameFunction,action=false,isSingle=false) {
        if(isSingle) {
            action?elements.removeEventListener('click',nameFunction):elements.addEventListener('click',nameFunction);
            return;
        }else {
            elements.forEach(e=>{
                action?e.removeEventListener('click',nameFunction):e.addEventListener('click',nameFunction);
            })
            return;
        }
    }

    // tạo thẻ
    function createElementNode(tagName,className,parentElement,clone=1) {
        const element = document.createElement(tagName);
        element.className = className;
        parentElement.appendChild(element);
        if(clone>1) {
            for(let i=0;i<clone;i++) {
                parentElement.appendChild(element.cloneNode(true));
            }
        }
    }

    function customInnerHTML (type,parentElement) {
        parentElement.innerHTML += type;
    }

    function AppenChild (P,C,A) {
        let index = C.length;

        // Thêm phần clone phần tử ở đầu
        if(loop) {
            for(let i = slideToShow;i>0;i--) {
                A.push(C[index-i].cloneNode(true))
            }
        }

        // Thêm phần tử ớ giữa
        for(let i=0;i<index;i++) {
            A.push(C[i]);
        }

        // Thêm phần tử ở cuối
        if(loop) {
            for(let i = 0;i<slideToShow ;i++) {
                A.push(C[i].cloneNode(true));
            }
        }
        // xóa phần tử
        P.innerHTML = '';
        
        // custom nutPrev;
        customInnerHTML(customPrev,P);
        
        // tạo thẻ chứa
        createElementNode('div','slider',P);
        
        // custom node Next
        customInnerHTML(customNext,P);

        // kiểm tra xem người dùng có muốn sử dựng dots ko
        if(slideDots) {
            createElementNode('ul','slider__dots',P);
            if($(`.${parentSlider} .slider__dots`)) {
                const sliderDots = $(`.${parentSlider} .slider__dots`);
                let indexE = ((slideToScroll==slideToShow)&&index-slideToScroll) || index - (slideToScroll + 1);
                createElementNode('li','slider__dots-items',sliderDots,(loop&&((index-1)/slideToScroll))||(indexE)/slideToScroll);
            }
        }
        if($(`.${parentSlider} .slider`)) {
            createElementNode('div','slider-strack',$(`.${parentSlider} .slider`));

            // lấy độ dài của mảng
            let ArrayIndex = A.length;
            
            if( $(`.${parentSlider} .slider .slider-strack`)) {
                const sliderTrack = $(`.${parentSlider} .slider .slider-strack`);
    
                // thêm các phần tử
                for(let i=0;i<ArrayIndex;i++) {
                    sliderTrack.appendChild(A[i]);
                }
            }
        }
    }

    const $ = document.querySelector.bind(document);
    const $$ = document.querySelectorAll.bind(document);
    const Default = 2000;
    const isSpamTime = 1300;
    let isErorr = true;

    if(!autoPlay&&((Duration > Default)||(Duration < Default))) {
        console.warn('Khi không sử dụng thuộc tính autoPlay không cần chuyển Duration!!!!');
    }
    else {
        if(Duration < Default) {
            Duration = Default;
            console.warn('Tối thiểu Duration phải lớn hơn hoặc bằng', Default);
        }
    }

    if(isSpamTime > timeSpam) {
        timeSpam = isSpamTime;
        console.warn('Thuộc tính timeSpam tối thiểu phải lớn hoặc bằng ',isSpamTime);
    }

    if(autoPlay&&Duration < timeSpam) {
        isErorr = false;
        console.error('Lưu ý: Duration phải lớn hơn timeSpam');
    }

    if(autoPlay&&!loop) {
        isErorr = false;
        console.error('Lưu ý: Khi sử dụng autoPlay thì phải có loop bằng true');    
    }

    if(slideToShow < slideToScroll) {
        isErorr = false;
        console.error('Lưu ý: Không được truyền slideToShow nhỏ hơn slideToScroll')
    }


    if($(`.${parentSlider}`)&&isErorr) {
        // lấy thẻ cha
        const parentElement = $(`.${parentSlider}`);

        // lấy ra chiều rộng của element
        let Width = parentElement.offsetWidth;

        // lấy tất cả thẻ chứa
        const childrenElement = parentElement.children;
        
        // lấy các thẻ con
        let arrayChildren = [];

        // Thêm lại cái childrenElement và thêm thẻ con
        AppenChild(parentElement,childrenElement,arrayChildren)

        // tổng số các Element
        let index = arrayChildren.length;

        let oneWidth = parseInt(Width/slideToShow);

        let newOneWidth = ((oneWidth*(slideToShow - 1) - (gap*(slideToShow-1)))) + oneWidth;

        let WD = newOneWidth/slideToShow;
        
        // // tổng số width 
        let totalWidth = ((WD * index) + (gap * index))
        
        // // vị trí bắt đầu
        let widthOption = (loop&&(WD*slideToShow) + (gap*slideToShow))||0;

        // // lấy element thanh trượt
        const sliderStrack = $(`.${parentSlider} .slider .slider-strack`);

        // // số lượng các thẻ con
        let newchildrenElement = sliderStrack.children; 
        
        // // Chỉnh chiều rộng và khoảng cách mặc định của element
        sliderStrack.style.width = `${totalWidth}px`;
 
        sliderStrack.style.transform = `translateX(-${widthOption}px)`;



        if($$('.slider__dots-items')&&slideDots) {
            var sliderDotsItems = $$('.slider__dots-items');
            var indexDotsElement = sliderDotsItems.length;
            sliderDotsItems.forEach((element,index)=>{
                if(index==0) {
                    element.classList.add('dots-active');
                }
                element.setAttribute('tab-index', (index));
            })
        }

        // chiều rộng
        let isActive = 1;
        for(let i=0;i<index;i++) {
            newchildrenElement[i].setAttribute('tab-index',loop?i-slideToShow:i);
            if(loop&&i>=slideToShow&&isActive<=slideToShow) {
                newchildrenElement[i].classList.add('slider-active');
                isActive++;
            } else if((i>=0&&isActive<=slideToShow)){
                newchildrenElement[i].classList.add('slider-active');
                isActive++;
            }
            newchildrenElement[i].style.width = `${WD}px`;
            if(gap>0) {
                newchildrenElement[i].style.marginRight = `${gap}px`;
            }
        }

        isActive = 1;

        // tồn tại thì mới làm việc tiếp
        if($(`.${parentSlider} button[aria-label="Previous"]`)&&$(`.${parentSlider} button[aria-label="Next"]`)) {
            let Dem = 0;
            let indexDots = 0;
            let optionX = 0;
            let isMax = index - (slideToShow * 2);
            let isClick = true;
            let scrollOddNext = 0;
            let scrollOddPrev = 0;
            let stopIndex = 0;
            let tabindexOld = 0;
            let indexClassListElement = 0;
            let indexClassActive = 0;
            let indexODD = loop?(index-slideToShow*2)%slideToScroll:(index-slideToShow)%slideToScroll;

            // lấy các thẻ control
            const NextItem = $(`.${parentSlider} button[aria-label="Next"]`);
            const PrevItem = $(`.${parentSlider} button[aria-label="Previous"]`);

            // thực hiện xử lý
            function nextSliderItem () {
                sliderStrack.style.removeProperty('transition');
                if(loop&&autoPlay&&isClick) {
                    if(scrollOddNext < indexODD&&Dem >= 0) {
                        Dem += indexODD;
                        scrollOddNext +=indexODD;
                    } else {
                        Dem +=slideToScroll;
                    }
                    indexDots++;
                }
                optionX = widthOption + (WD * Dem) + (gap * Dem);
                if(sliderDotsItems!=null&&slideDots) {
                    if(loop) {
                        if(indexDots < 0) {
                            indexDots = indexDotsElement - 1;
                        } else if(indexDots >= indexDotsElement) {
                            indexDots = 0;
                        }
                    }

                    // // tìm thẻ có classActive rồi xóa bỏ
                    let elementActive = $('.slider__dots-items.dots-active');
                    // xóa bỏ class
                    elementActive.classList.remove('dots-active');
                    // add class
                    sliderDotsItems[indexDots].classList.add('dots-active');
                }

                // chèn hiệu ứng cho thanh trượt
                sliderStrack.style.transform = `translateX(-${optionX}px)`;
                sliderStrack.style.transition = `all ${enforcementTransition}ms`;

                setTimeout(()=>{
                    sliderStrack.style.removeProperty('transition')
                    if(loop&&autoPlay&&!isClick==true) {
                        auto = setInterval(nextSliderItem,Duration);
                    }
                    if(loop) {
                        if(Dem >= isMax) {
                            Dem = 0;
                            optionX = widthOption;
                            scrollOddNext = 0;
                        } else if(Dem < 0){
                            Dem = index - (slideToShow + slideToScroll);
                            optionX = (WD * Dem) + (gap * Dem);
                            Dem-=slideToShow;
                            scrollOddPrev = 0;
                        }
                        sliderStrack.style.transform =`translateX(-${optionX}px)`;
                    }
                },timeSpam)
            }

            if(autoPlay) {
                var auto = setInterval(nextSliderItem,Duration);
            }
            
            function handelNext() {
                clearInterval(auto);
                isClick=false;
                // ktra người dùng có muốn lặp ko
                removeAddEvent(PrevItem,handelPrev,true,true);
                removeAddEvent(NextItem,handelNext,true,true);

                setTimeout(()=>{
                    removeAddEvent(NextItem,handelNext,false,true);
                    removeAddEvent(PrevItem,handelPrev,false,true);
                },timeSpam)
                if(!loop) {
                    if(Dem == (index-slideToShow)) {
                        return;
                    }
                }
                if(scrollOddNext < indexODD&&Dem >= 0||Dem >= index - 1) {
                    Dem += indexODD;
                    scrollOddNext+=indexODD;
                } else {
                    Dem +=slideToScroll;
                }

                indexDots++;
                nextSliderItem ();
                setTimeout(() => {
                    isClick = true
                }, timeSpam);
            }

            // lắng nghe sự kiện nút next
            NextItem.addEventListener('click',handelNext)

            function handelPrev () {
                clearInterval(auto);
                isClick=false;
                // ktra người dùng có muốn lặp ko
                removeAddEvent(NextItem,handelNext,true,true);
                removeAddEvent(PrevItem,handelPrev,true,true);

                setTimeout(()=>{
                    removeAddEvent(PrevItem,handelPrev,false,true);
                    removeAddEvent(NextItem,handelNext,false,true);
                },timeSpam)
                if(!loop) {
                    if(Dem==0) {
                        return;
                    }
                } 
                if(scrollOddPrev < indexODD && Dem < index && Dem > 0) {
                    Dem -= indexODD;
                    scrollOddPrev += indexODD;
                } else {
                    Dem -= slideToScroll;
                }
                indexDots--;
                nextSliderItem ()

                setTimeout(() => {
                    isClick = true
                }, timeSpam);
            }
            // lắng nghe sự kiện nút prev
            PrevItem.addEventListener('click',handelPrev)

            // kiểm tra dots
            if(sliderDotsItems) {
                function handelEventDots(e) {
                    clearInterval(auto);
                    isClick=false;
                    let index = sliderDotsItems.length;
                    let tabIndex = parseInt((e.target).getAttribute('tab-index'));

                    // tránh spam xóa bỏ sự kiện click
                    removeAddEvent (sliderDotsItems,handelEventDots,true)

                    // lấy thông tin của thẻ gán vào biến đếm
                    indexDots = tabIndex;

                    if(stopIndex === 0) {
                        tabindexOld = indexDots;
                    }

                    if(scrollOddNext < indexODD&&Dem >= 0) {
                        Dem += indexODD;
                        scrollOddNext+= indexODD;
                    } else {
                        if(stopIndex !=0 &&tabindexOld < indexDots) {
                            tabindexOld = indexDots;
                            Dem += tabindexOld;
                        } else if (stopIndex !=0 &&tabindexOld > indexDots) {
                            tabindexOld = indexDots;
                            Dem -= indexDots;
                        }
                    }
                    nextSliderItem();
                    // add event
                    setTimeout(()=>{
                        isClick = true;
                        stopIndex = 1;
                        removeAddEvent (sliderDotsItems,handelEventDots,false)
                    },timeSpam);
                }
                removeAddEvent (sliderDotsItems,handelEventDots,false)
            }
        } else {
            console.error("Vui lòng kiểm tra lại tên class có thể một hoặc hai trả về `undefined`")
        }
    }else {
        isErorr&&console.error('kiểm tra lại tên class '+ parentSlider);
    }
}
