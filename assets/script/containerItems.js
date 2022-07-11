const stampInfos = [
                    {
                        num:'#56',
                        title:'HRH Prince Albert (1851)',
                        date:'18 juin - 21 juil. 22',
                        price:1495
                    },
                    {
                        num:'#57',
                        title:'HRH Prince Albert (1851) 6d',
                        date:'18 juin - 21 juil. 22',
                        price:245
                    },
                    {
                        num:'#58',
                        title:'Reine Victoria (1851) 12d',
                        date:'23 juin - 05 aout 22',
                        price:2500
                    },
                    {
                        num:'#59',
                        title:'HRH Prince Albert (1851)',
                        date:'18 juin - 21 juil. 22',
                        price:1495
                    },
                    {
                        num:'#60',
                        title:'Jacques Cartier (1855) 10d',
                        date:'23 juin - 05 aout 22',
                        price:995
                    },
                    {
                        num:'#61',
                        title:'Reine Victoria (1859) 1¢',
                        date:'23 juin - 05 aout 22',
                        price:195
                    },
                    {
                        num:'#62',
                        title:'Reine Victoria (1859) rose 1¢',
                        date:'23 juillet - 05 aout 22',
                        price:745
                    },
                    {
                        num:'#63',
                        title:'Reine Victoria (1868) ½¢',
                        date:'15juil - 21 juil. 22',
                        price:135
                    },
                    {
                        num:'#56',
                        title:' Reine Victoria (1868) vert ½¢',
                        date:'15juil - 21 juil. 22',
                        price:125
                    },
                    {
                        num:'#64',
                        title:'Reine Victoria (1868) brun 6¢',
                        date:'15juil  - 21 juil. 22',
                        price:80
                    },
                    {
                        num:'#65',
                        title:'Reine Victoria (1868) jaune 6¢',
                        date:'18 juil - 21 aout 22',
                        price:1495
                    },
                    {
                        num:'#66',
                        title:'Reine Victoria (1868) bleu 12½¢',
                        date:'18 juin - 21 aout 22',
                        price:995
                    }
];

const catalogItemInfos = [
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

const elParentContainerItems = document.getElementById('container-items');
const elCatalogGridContainer = document.getElementById('catalog-grid-container');

for (let i = 8; i < 12; i++) {
    const domString = `
                    <div class="grid-item"">
                        <a href="#">
                            <div class="image-container"><img src="./assets/image/stamps/stamp${i + 1}.jpg" alt=""></div>
                            <div class="grid-item-description">
                                <h6>${stampInfos[i].num}</h6>
                                <h6>${stampInfos[i].title}</h6>
                                <p class="light">${stampInfos[i].date}</p>
                                <p>Offre actuelle : ${stampInfos[i].price}$</p>
                            </div>
                            <button class="colored-button">Miser</button>
                        </a>
                    </div>
                    `;
    elParentContainerItems.insertAdjacentHTML('beforeend', domString);
}

for (let i = 0; i < 4; i++) {
    const domString = `
                    <div class="grid-item catalog-grid-item"">
                        <div class="image-container"><img src="./assets/image/index-catalogue-img-${i + 1}.png" alt=""></div>
                        <div class="grid-item-description catalog-grid-item-description">
                            <h4>${catalogItemInfos[i].title}</h4>
                            <p class="light">${catalogItemInfos[i].date}</p>
                        </div>
                        <button class="colored-button">Tout voir</button>
                    </div>
                    `;
    elCatalogGridContainer.insertAdjacentHTML('beforeend', domString);
}