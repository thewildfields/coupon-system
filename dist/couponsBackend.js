(()=>{var e={248:()=>{const e=document.querySelectorAll(".acf-readonly input"),t=document.querySelector(".couponSystem__releaseLimit input"),r=document.querySelector(".couponSystem__availableCoupons input");for(let t=0;t<e.length;t++)e[t].setAttribute("readonly","readonly");t&&r&&(t.addEventListener("input",(function(){Number(r.value)>Number(t.value)&&(r.value=t.value)})),r.addEventListener("input",(function(){Number(r.value)>Number(t.value)&&(r.value=t.value)})))}},t={};function r(u){var n=t[u];if(void 0!==n)return n.exports;var o=t[u]={exports:{}};return e[u](o,o.exports,r),o.exports}r.n=e=>{var t=e&&e.__esModule?()=>e.default:()=>e;return r.d(t,{a:t}),t},r.d=(e,t)=>{for(var u in t)r.o(t,u)&&!r.o(e,u)&&Object.defineProperty(e,u,{enumerable:!0,get:t[u]})},r.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),(()=>{"use strict";r(248)})()})();