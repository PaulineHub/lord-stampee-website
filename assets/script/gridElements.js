const elParent = document.getElementById('grid');

const domString = `
                    <div class="grid-item"">
                        <a href="#">
                            <div class="image-container"><img src="./assets/image/image.png" alt=""></div>
                            <div class="grid-item-description">
                                <h6>68</h6>
                                <h6>Canada 1897 # 56 stamp vf</h6>
                                <p class="light">18 juin - 21 juil. 22</p>
                                <p>Offre actuelle : 120$</p>
                            </div>
                        </a>
                    </div>
                    `

for (let i = 0; i < 12; i++) {
    elParent.insertAdjacentHTML('beforeend', domString);
}