var accordions = document.getElementsByClassName("accordion-button");

for (let i = 0; i < accordions.length; i++) {
    accordions[i].addEventListener("click", function () {
        this.classList.toggle("active");

        let panel = this.nextElementSibling;
        let arrow = this.querySelector('.accordion-arrow');

        const rotation = arrow.style.transform;
        if (rotation === '') {
            rotationDeg = 0;
        } else {
            rotationDeg = parseInt(rotation.match(/\d+/));
        }

        if (panel.style.display === 'flex') {
            panel.style.display = 'none';
            arrow.style.transform = 'rotate(' + (rotationDeg + 180) + 'deg)';
        } else {
            panel.style.display = 'flex';
            arrow.style.transform = 'rotate(' + (rotationDeg + 180) + 'deg)';
        }
    });
}