import { Ajax } from './modules/ajax.js';

// Functions for MyItemsArray
export function getMyItemsJson() {
    const storedData = JSON.parse(localStorage.getItem('MyItemsArray'));
    return storedData;
}
  
export function getMyItemsArray() {
    const storedData = getMyItemsJson();
    let data = [];
    storedData.forEach(element => {
        data.push(element);
    });
    return data; 
}


// Functions for ItemsArray
export function getItemsJson(){
    const storedData = JSON.parse(localStorage.getItem('ItemsArray'));
    return storedData;
}

export function getItemsArray() {
    const storedData = getItemsJson();
    let data = [];
    storedData.forEach(element => {
        data.push(element);
    });
    return data; 
}

// Functions for StoresArray
export function getStoresJson(){
    const storedData = JSON.parse(localStorage.getItem('StoresArray'));
    return storedData;
}

export function getStoresArray() {
    const storedData = getStoresJson();
    let data = [];
    storedData.forEach(element => {
        data.push(element);
    });
    return data; 
}


// Functions for AccountDetails
export function getAccountDetailsJson(){
    const storedData = JSON.parse(localStorage.getItem('AccountDetails'));
    return storedData;
}

export function getAccountDetailsArray() {
    const storedData = getAccountDetailsJson();
    let data = [];
    storedData.forEach(element => {
        data.push(element);
    });
    return storedData; 
}


// Functions for Transactions
export function getTransactionsJson(){
    const storedData = JSON.parse(localStorage.getItem('Transactions'));
    return storedData;
}

export function getTransactionsArray() {
    const storedData = getTransactionsJson();
    let data = [];
    storedData.forEach(element => {
        data.push(element);
    });
    return storedData; 
}


export function AddItemToCart(newItem){
    let cartData = GetItemsFromCart();
    cartData.push(newItem);
    localStorage.setItem('Carts', JSON.stringify(cartData));
}

export function ModifyItemQuantityFromCart(type, ItemId) {
    let cartData = GetItemsFromCart();
    const foundItemIndex = cartData.findIndex(item => item._itemId === ItemId);

    if (type === "add") {
        if (foundItemIndex !== -1) {
            if (cartData[foundItemIndex].addQuantity()) {
                localStorage.setItem('Carts', JSON.stringify(cartData));
                return true;
            } else {
                return false;
            }
        }
    } else if (type === "less") {
        if (foundItemIndex !== -1) {
            if (cartData[foundItemIndex].lessQuantity()) {
                if (cartData[foundItemIndex].itemQuantity === "0") {
                    cartData.splice(foundItemIndex, 1);
                }
                localStorage.setItem('Carts', JSON.stringify(cartData));
                return true;
            } else {
                cartData.splice(foundItemIndex, 1);
                localStorage.setItem('Carts', JSON.stringify(cartData));
                return false;
            }
        }
    }
    return false;
}

export function GetItemsFromCart() {
    const cartData = localStorage.getItem('Carts');
    if (!cartData) {
        return []; 
    }
    const cartInstances = JSON.parse(cartData);
    const Carts = cartInstances.map(cartObj => {
        return new Cart(
            cartObj._itemId,
            cartObj._itemName,
            cartObj._itemPrice,
            cartObj._itemImage,
            cartObj._storeId,
            cartObj._storeName,
            cartObj._storeImage,
            cartObj._itemQuantity
        );
    });
    return Carts;
}







export class Store {
    constructor(StoreId, StoreName, StoreImage, StoreOwner) {
        this._StoreId = StoreId;
        this._StoreName = StoreName;
        this._StoreImage = StoreImage;
        this._StoreOwner = StoreOwner;
    }
    get StoreId() {
        return this._StoreId;
    }
    set StoreId(newStoreId) {
        this._StoreId = newStoreId;
    }
    get StoreName() {
        return this._StoreName;
    }
    set StoreName(newStoreName) {
        this._StoreName = newStoreName;
    }
    get StoreImage() {
        return this._StoreImage;
    }
    set StoreImage(newStoreImage) {
        this._StoreImage = newStoreImage;
    }
    get StoreOwner() {
        return this._StoreOwner;
    }
    set StoreOwner(newStoreOwner) {
        this._StoreOwner = newStoreOwner;
    }
}

export class Item {
    constructor(ItemId, ItemName, ItemCategory, ItemPrice, ItemImage, StoreId, StoreName, StoreImage, StoreOwner) {
        this._ItemId = ItemId;
        this._ItemName = ItemName;
        this._ItemCategory = ItemCategory;
        this._ItemPrice = ItemPrice;
        this._ItemImage = ItemImage;
        this._StoreId = StoreId;
        this._StoreName = StoreName;
        this._StoreImage = StoreImage;
        this._StoreOwner = StoreOwner;
    }
    get ItemId() {
        return this._ItemId;
    }
    set ItemId(newItemId) {
        this._ItemId = newItemId;
    }
    get ItemName() {
        return this._ItemName;
    }
    set ItemName(newItemName) {
        this._ItemName = newItemName;
    }
    get ItemCategory() {
        return this._ItemCategory;
    }
    set ItemCategory(newItemCategory) {
        this._ItemCategory = newItemCategory;
    }
    get ItemPrice() {
        return this._ItemPrice;
    }
    set ItemPrice(newItemPrice) {
        this._ItemPrice = newItemPrice;
    }
    get ItemImage() {
        return this._ItemImage;
    }
    set ItemImage(newItemImage) {
        this._ItemImage = newItemImage;
    }
    get StoreId() {
        return this._StoreId;
    }
    set StoreId(newStoreId) {
        this._StoreId = newStoreId;
    }
    get StoreName() {
        return this._StoreName;
    }
    set StoreName(newStoreName) {
        this._StoreName = newStoreName;
    }
    get StoreImage() {
        return this._StoreImage;
    }
    set StoreImage(newStoreImage) {
        this._StoreImage = newStoreImage;
    }
    get StoreOwner() {
        return this._StoreOwner;
    }
    set StoreOwner(newStoreOwner) {
        this._StoreOwner = newStoreOwner;
    }
}

export class Cart {
    constructor(itemId, itemName, itemPrice, itemImage, storeId, storeName, storeImage, itemQuantity) {
        this._itemId = itemId;
        this._itemName = itemName;
        this._itemPrice = itemPrice;
        this._itemImage = itemImage;
        this._storeId = storeId;
        this._storeName = storeName;
        this._storeImage = storeImage;
        this._itemQuantity = itemQuantity;
    }
    addQuantity() {
        this._itemQuantity = (Number(this._itemQuantity) + 1);
        return true;
    }
    lessQuantity() {
        this._itemQuantity = (Number(this._itemQuantity) - 1);
        if (Number(this._itemQuantity) > 0) {
            return true;
        } else {
            return false;
        }
    }
    get itemId() {
        return this._itemId;
    }
    set itemId(newItemId) {
        this._itemId = newItemId;
    }
    get itemName() {
        return this._itemName;
    }
    set itemName(newItemName) {
        this._itemName = newItemName;
    }
    get itemPrice() {
        return this._itemPrice;
    }
    set itemPrice(newItemPrice) {
        this._itemPrice = newItemPrice;
    }
    get itemImage() {
        return this._itemImage;
    }
    set itemImage(newItemImage) {
        this._itemImage = newItemImage;
    }
    get storeId() {
        return this._storeId;
    }
    set storeId(newStoreId) {
        this._storeId = newStoreId;
    }
    get storeName() {
        return this._storeName;
    }
    set storeName(newStoreName) {
        this._storeName = newStoreName;
    }
    get storeImage() {
        return this._storeImage;
    }
    set storeImage(newStoreImage) {
        this._storeImage = newStoreImage;
    }
    get itemQuantity() {
        return this._itemQuantity;
    }
    set itemQuantity(newItemQuantity) {
        this._itemQuantity = newItemQuantity;
    }
}





export function refreshAllItems (AccountId, AuthToken, StoreId){
    var formData = new FormData();
    formData.append('AuthToken', AuthToken);
    formData.append('AccountId', AccountId);
    formData.append('StoreId', StoreId);
    formData.append('Intent', 'Select Items');
    Ajax.postFormData('../php/api/item.php', formData)
    .then(responseJSON => {
        localStorage.setItem('ItemsArray', JSON.stringify(responseJSON));
    })
    .catch(error => {
        console.error('Error:', error); 
    });
}

export function refreshMyItems (AccountId, AuthToken, StoreId){
    var formData = new FormData();
    formData.append('AuthToken', AuthToken);
    formData.append('AccountId', AccountId);
    formData.append('StoreId', StoreId);
    formData.append('Intent', 'Select MyItems');
    Ajax.postFormData('../php/api/item.php', formData)
    .then(responseJSON => {
        localStorage.setItem('MyItemsArray', JSON.stringify(responseJSON));
    })
    .catch(error => {
        console.error('Error:', error); 
    });
}

export function refreshAllStores (AccountId, AuthToken, StoreId){
    var formData = new FormData();
    formData.append('AuthToken', AuthToken);
    formData.append('AccountId', AccountId);
    formData.append('StoreId', StoreId);
    formData.append('Intent', 'Select Store');
    Ajax.postFormData('../php/api/store.php', formData)
    .then(responseJSON => {
        localStorage.setItem('StoresArray', JSON.stringify(responseJSON));
    })
    .catch(error => {
        console.error('Error:', error); 
    });
}

export function refreshAccountDetails (Intent, AccountId, AuthToken){
    var formData = new FormData();
    formData.append('AuthToken', AuthToken);
    formData.append('AccountId', AccountId);
    formData.append('Intent', Intent);
    Ajax.postFormData('../php/api/account.php', formData)
    .then(responseJSON => {
        localStorage.setItem('AccountDetails', JSON.stringify(responseJSON));
    })
    .catch(error => {
        console.error('Error:', error); 
    });
}

export function refreshTransactions (AccountId, AuthToken){
    var formData = new FormData();
    formData.append('AuthToken', AuthToken);
    formData.append('AccountId', AccountId);
    formData.append('Intent', 'Select Transaction');
    Ajax.postFormData('../php/api/transactions.php', formData)
    .then(responseJSON => {
        localStorage.setItem('Transactions', JSON.stringify(responseJSON));
    })
    .catch(error => {
        console.error('Error:', error); 
    });
}



export async function fetchAllItems (AccountId, AuthToken, StoreId){
    var formData = new FormData();
    formData.append('AuthToken', AuthToken);
    formData.append('AccountId', AccountId);
    formData.append('StoreId', StoreId);
    formData.append('Intent', 'Select Items');

    try {
        const responseJSON = await Ajax.postFormData('../php/api/item.php', formData);
        return responseJSON;
    } catch (error) {
        console.error('Error:', error);
        throw error;
    }
}

export async function fetchStoresItems (AccountId, AuthToken, StoreId){
    var formData = new FormData();
    formData.append('AuthToken', AuthToken);
    formData.append('AccountId', AccountId);
    formData.append('StoreId', StoreId);
    formData.append('Intent', 'Select Items');

    try {
        const responseJSON = await Ajax.postFormData('../php/api/item.php', formData);
        return responseJSON;
    } catch (error) {
        console.error('Error:', error);
        throw error;
    }
}