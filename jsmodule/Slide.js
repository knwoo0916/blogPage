import $ from 'jquery';

export default class Slide {
    constructor() {
        this.current = 0;
        this.sList = $(".slide-image"); //
        this.indiList = $(".indicator li"); //인디케이터 버튼
        this.slideBtn = $(".btn-div > button"); //이전 이후 버튼

        this.slideBtn.each((idx, target) => {
            $(target).data("idx", idx);
        });
        this.slideBtn.on("click", (e) => {
            let idx = $(e.target).data("idx");
            if (idx == 1) { //다음
                this.slide(this.current > 2 ? this.current = 0 : this.current + 1);
            } else { //이전
                this.slide(this.current < 0 ? this.current = 3 : this.current - 1);
            }
        });

        this.indiList.each((idx, target) => {
            $(target).data("idx", idx);
        });

        this.endSlide();

        this.indiList.on("click", (e) => {
            let idx = $(e.target).data("idx");
            this.slide(idx);
        });

        this.sList.eq(0).css({ left: 0 });

        this.easing = "linear";
        this.slideTime = 500;
    }


    slide(idx) {
        if (this.current == idx || this.sliding) return;
        if (idx < 0) {
            this.indiList.removeClass("active");
            this.indiList.eq(2).addClass("active");
        } else if (idx > 2) {
            this.indiList.removeClass("active");
            this.indiList.eq(0).addClass("active");
        } else {
            this.indiList.removeClass("active");
            this.indiList.eq(idx).addClass("active");
        }




        this.sliding = true;
        if (this.current < idx) { //오른쪽으로 이동
            if (idx > 2) idx = 0;
            this.sList.eq(idx).css({ "left": "100%" });
            this.sList.eq(idx).animate({ left: "0%" }, this.slideTime, this.easing, () => {
                this.endSlide();
            });
            this.sList.eq(this.current).animate({ left: "-100%" }, this.slideTime, this.easing);
        } else { //왼쪽으로 이동
            if (idx < 0) idx = 2;
            this.sList.eq(idx).css({ "left": "-100%" });
            this.sList.eq(idx).animate({ left: "0%" }, this.slideTime, this.easing, () => {
                this.endSlide();
            });

            this.sList.eq(this.current).animate({ "left": "100%" }, this.slideTime, this.easing);
        }
        this.current = idx;
    }

    endSlide() {
        this.sliding = false;
    }
}