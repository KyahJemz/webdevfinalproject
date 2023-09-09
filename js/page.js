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
            setSuggestedItems();
            setSuggestedStores();
            
            console.log(Items);
        } else {
            console.log('fetchItems is not an array.');
        }
    } catch (error) {
        console.error('Error:', error);
    }
})();

const helper = new Helper();

// #################################################
// HORIZONTAL SCROLL
// #################################################
const SuggestedItemsContainer = document.getElementById('suggested-items-container');
const SuggestedStoresContainer = document.getElementById('suggested-stores-container');
SuggestedItemsContainer.addEventListener("wheel", (e) => {
    e.preventDefault(); 
    SuggestedItemsContainer.scrollLeft += e.deltaY; 
});
SuggestedStoresContainer.addEventListener("wheel", (e) => {
    e.preventDefault(); 
    SuggestedStoresContainer.scrollLeft += e.deltaY; 
});

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
  
function setSuggestedItems() {
    const randomItems = getRandomFromArray(Items, 20);
    addBanner(randomItems[0]);
    randomItems.forEach(item => {
        SuggestedItemsContainer.innerHTML += `
            <div class="card-item" data-itemid="${item._ItemId}" data-itemname="${item._ItemName}" data-itemcategory="${item._ItemCategory}" data-itemprice="${item._ItemPrice}" data-itemimage="${item._ItemImage}" data-itemstorename="${item._StoreName}" data-itemstoreimage="${item._StoreImage}">
                <div class="StoreName">${item._StoreName}</div>
                <div class="ItemImage"><img src="../images/uploads/items/${item._ItemImage}" alt=""></div>
                <div class="ItemName">${item._ItemName}</div>
                <div class="ItemCategory">${item._ItemCategory}</div>
                <div class="ItemPrice">${helper.formatPrice(item._ItemPrice)}</div>
                <div class="Button"><button>Add to cart</button></div>
            </div>
        `;
    });
}

function setSuggestedStores() {
    const randomItems = getRandomFromArray(Stores, 20);
    randomItems.forEach(item => {
        SuggestedStoresContainer.innerHTML += `
            <div class="card-item" data-storeid="${item._StoreId}" data-storename="${item._StoreName}" data-storeimage="${item._StoreImage}" data-storeaccountid="${item._AccountId}">
                <div class="StoreImage"><img src="../images/uploads/stores/${item._StoreImage}" alt=""></div>
                <div class="StoreName">${item._StoreName}</div>
                <div class="Button"><button>View Shop</button></div>
            </div>
        `;
    });
}

function addBanner(item){
    if (item) {
        document.querySelector('.banner-title').innerHTML = item._ItemName;
        document.querySelector('.banner-subtitle').innerHTML = 'Delight Delivered, One Click Away'
        document.querySelector('.banner-image').src = '../images/uploads/items/' + item.ItemImage;
    } else {
        document.querySelector('.banner-title').innerHTML = 'KAINAN';
        document.querySelector('.banner-subtitle').innerHTML = 'Delight Delivered, One Click Away';
        document.querySelector('.banner-image').src = '../images/default_banner.jpg';
    }
}

