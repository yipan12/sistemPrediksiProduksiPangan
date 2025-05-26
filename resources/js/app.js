// resources/js/app.js
import { Button } from "bootstrap";
import "./bootstrap";
import gsap from "gsap";
import { renderingProductionChart } from "./chart";
import { renderingBarChart } from "./barchart";

const flipStates = {};

document.addEventListener("DOMContentLoaded", function () {
    if (document.querySelector("#productionChart")) {
        renderingProductionChart();
    }

    if (document.querySelector("#barChart")) {
        renderingBarChart();
    }
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
