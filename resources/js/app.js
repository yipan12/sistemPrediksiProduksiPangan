// resources/js/app.js
import { Button } from "bootstrap";
import "./bootstrap";
import gsap from "gsap";
import { initCharts } from "./charts";
import Alpine from "alpinejs";
import { timeAgo } from "./timeAgo";
import "./perbandinganChartAkurasiPrediksi";
import "./input";

Alpine.data("timeAgo", timeAgo);
window.Alpine = Alpine;
Alpine.start();
const flipStates = {};

document.addEventListener("DOMContentLoaded", function () {
    initCharts();
});

function flipCard(cardId) {
    const flipInner = document.getElementById(`flip-${cardId}`);
    const isFlipped = flipStates[cardId];
    const button = document.querySelector(`#card-${cardId} button`);
    gsap.to(button, { scale: 0.8, duration: 0.1, yoyo: true, repeat: 1 });

    if (!isFlipped) {
        gsap.to(flipInner, {
            rotationY: 180,
            duration: 0.8,
            ease: "power2.inOut",
        });
        flipStates[cardId] = true;
    } else {
        gsap.to(flipInner, {
            rotationY: 0,
            duration: 0.8,
            ease: "power2.inOut",
        });
        flipStates[cardId] = false;
    }
}

window.flipCard = flipCard;
