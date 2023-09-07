import { Helper } from './modules/helper.js';
import { Ajax } from './modules/ajax.js';
import { 
    Item, 
    Store, 
    CartItem ,
    getMyItemsArray, addMyItemsArray, clearMyItemsArray,
    getItemsArray, addItemToArray, clearItemsArray,
    getStoresArray, addStoreToArray, clearStoresArray,
    getMyCartArray, addItemToCart, clearMyCartArray,
    refreshAllItems, refreshMyItems, refreshAllStores
} from './class.js';

refreshAllItems(AccountId, AuthToken, StoreId);
refreshMyItems(AccountId, AuthToken, StoreId);
refreshAllStores(AccountId, AuthToken, StoreId);

const helper = new Helper();

const SuggestedItemsContainer = document.getElementById('suggested-items-container');
const SuggestedStoresContainer = document.getElementById('suggested-stores-container');

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
    setTimeout(() => {
        const itemsArray = getItemsArray();
        const randomItems = getRandomFromArray(itemsArray, 20);
        randomItems.forEach(item => {
            SuggestedItemsContainer.innerHTML += `
                <div class="card-item" data-itemid="${item.ItemId}" data-itemname="${item.ItemName}" data-itemcategory="${item.ItemCategory}" data-itemprice="${item.ItemPrice}" data-itemimage="${item.ItemImage}">
                    <div class="StoreName">wonder shop</div>
                    <div class="ItemImage"><img src="../images/uploads/items/${item.ItemImage}" alt=""></div>
                    <div class="ItemName">${item.ItemName}</div>
                    <div class="ItemCategory">${item.ItemCategory}</div>
                    <div class="ItemPrice">P${item.ItemPrice}</div>
                    <div class="Button"><button>Add to cart</button></div>
                </div>
            `;
        });
    }, 1000);
}

function setSuggestedStores() {
    setTimeout(() => {
        const storesArray = getStoresArray();
        const randomItems = getRandomFromArray(storesArray, 20);
        randomItems.forEach(item => {
            SuggestedStoresContainer.innerHTML += `
                <div class="card-item" data-storeid="${item.StoreId}" data-storename="${item.StoreName}" data-storeimage="${item.StoreImage}" data-storeaccountid="${item.AccountId}">
                    <div class="StoreImage"><img src="../images/uploads/stores/${item.StoreImage}" alt=""></div>
                    <div class="StoreName">${item.StoreName}</div>
                    <div class="Button"><button>View Shop</button></div>
                </div>
            `;
        });
    }, 1000);
}

setSuggestedItems();
setSuggestedStores();