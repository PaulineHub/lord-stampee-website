
export default class ContainerItem {

    constructor() {
       this.catalogItemInfos = [
                        {
                            title:'Collection privée',
                            date:'Le 14 et 15 juin 2022'
                        },
                        {
                            title:'Collection ferrovière',
                            date:'Le 24 et 25 juin 2022'
                        },
                        {
                            title:'Collection maritime',
                            date:'Le 04 et 05 juillet 2022'
                        },
                        {
                            title:'Collection avec cachet',
                            date:'Le 11 et 15 juillet 2022'
                        }
        ];

        this._elCatalogGridContainer = document.getElementById('catalog-grid-container');


       this.init();
    }
    
    init() {
        for (let i = 0; i < 4; i++) {
            const domString = `
                            <div class="grid-item catalog-grid-item"">
                                <div class="image-container image-container-accueil"><img src="./ressources/images/index-catalogue-img-${i + 1}.png" alt=""></div>
                                <div class="grid-item-description catalog-grid-item-description">
                                    <h4>${this.catalogItemInfos[i].title}</h4>
                                    <p class="light">${this.catalogItemInfos[i].date}</p>
                                </div>
                                <button class="colored-button">Voir</button>
                            </div>
                            `;
            this._elCatalogGridContainer.insertAdjacentHTML('beforeend', domString);
        }
        
    }



}