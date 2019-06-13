import Slide from './Slide';
import $ from 'jquery';

export default class App {
    constructor() {
        this.makeSlider();
        this.addEventList();
    }

    makeToast(msg) {
        const template =
            `<div class="my-toast bg-info">
                <div class="content">${msg}</div>
            </div>`;
        let toast = $(template).appendTo($("#toastList"));
        setTimeout(() => {
            toast.fadeOut();
        }, 2000);
    }

    addEventList() {
        $("#btnSubmenu").on("click", (e) => {
            $("#submenu").addClass("active");
            e.stopPropagation();
        });
        $("#submenu").on("click", (e) => {
            e.stopPropagation();
        });

        $("body").on("click", () => {
            $("#submenu").removeClass("active");
        });
    }

    makeSlider() {
        this.slide = new Slide();
    }
}