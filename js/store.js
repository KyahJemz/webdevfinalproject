import { Helper } from './modules/helper.js';
import { Ajax } from './modules/ajax.js';
import { 
    Item,
    Store,
    fetchAllItems,
} from './class.js';

var Items = [];
var Stores = [];
var Carts = [];

const uniqueCategories = new Set();

(async () => {
    try {
        const fetchItems = await fetchAllItems(AccountId, AuthToken, StoreId);
        if (Array.isArray(fetchItems)) {
            fetchItems.forEach(element => {
                Items.push(new Item(
                    element['ItemId'],
                    element['ItemName'],
                    element['ItemCategory'],
                    element['ItemPrice'],
                    element['ItemImage'],
                    element['StoreId'],
                    element['StoreName'],
                    element['StoreImage'],
                    element['AccountId']
                ));
                if (element['StoreId']) {
                    if (!uniqueCategories.has(element['StoreId'])) {
                        uniqueCategories.add(element['StoreId']);
                        Stores.push(new Store(
                            element['StoreId'],
                            element['StoreName'],
                            element['StoreImage'],
                            element['AccountId']
                        ));
                    }
                }
            });
            setStores();
            console.log(Items);
        } else {
            console.log('fetchItems is not an array.');
        }
    } catch (error) {
        console.error('Error:', error);
    }
})();

const helper = new Helper();

function getRandomFromArray(array, count) {
    const shuffled = array.slice();
    let i = array.length;
    const results = [];
    while (i--) {
        const rand = Math.floor(Math.random() * (i + 1));
        [shuffled[i], shuffled[rand]] = [shuffled[rand], shuffled[i]];
    }
    if (array.length <= count) {
        return shuffled;
    }
    for (let j = 0; j < count; j++) {
        results.push(shuffled[j]);
    }
    return results;
}


function setStores(){
    let container = document.querySelector('.stores-grid-container .grid-container');
    let StoreList = getRandomFromArray(Stores, Stores.length);
    container.innerHTML = ``;

    StoreList.forEach(element => {
        container.innerHTML = container.innerHTML + `
            <div class="grid-item" data-storeid="${element._StoreId}" data-storename="${element._StoreName}" data-storeimage="${element._StoreImage}">
                <div class="StoreImage"><img src="../images/uploads/stores/${element._StoreImage}" alt=""></div>
                <div class="StoreName">${element._StoreName}</div>
                <div class="Button"><button>View Shop</button></div>
            </div>
        `;
    });
}







                    
