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

// Functions for MyCartArray
export function getMyCartJson(){
    return MyCartArray;
}

export function getMyCartArray() {
    const storedData = getMyCartJson();
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

export class Item {
    constructor(id,name,category,price,image,storeid){
        this.id = id;
        this.name = name;
        this.category = category;
        this.price = price;
        this.iamge = image;
        this.storeid = storeid;
    }   
}

export class Store {
    constructor(id,name,address,owner,image){
        this.id = id;
        this.name = name;
        this.address = address;
        this.owner = owner;
        this.iamge = image;
    }   
}

export class CartItem {
    constructor(itemId,itemName,itemPrice,quantity,itemShop){
        this.itemId = itemId;
        this.itemName = itemName;
        this.itemPrice = itemPrice;
        this.quantity = quantity;
        this.itemShop = itemShop;
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

