import { Ajax } from './modules/ajax.js';


var ItemsArray = [];
var StoresArray = [];
var MyCartArray = [];
var MyItemsArray = [];

// Functions for MyItemsArray
export function getMyItemsArray(){
    return MyItemsArray;
}

export function addMyItemsArray(value){
    MyItemsArray.push(value);
}

export function clearMyItemsArray(){
    MyItemsArray.length = 0;
}

// Functions for ItemsArray
export function getItemsArray(){
    return ItemsArray;
}

export function addItemToArray(value){
    ItemsArray.push(value);
}

export function clearItemsArray(){
    ItemsArray.length = 0;
}

// Functions for StoresArray
export function getStoresArray(){
    return StoresArray;
}

export function addStoreToArray(value){
    StoresArray.push(value);
}

export function clearStoresArray(){
    StoresArray.length = 0;
}

// Functions for MyCartArray
export function getMyCartArray(){
    return MyCartArray;
}

export function addItemToCart(value){
    MyCartArray.push(value);
}

export function clearMyCartArray(){
    MyCartArray.length = 0;
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
    clearItemsArray();
    Ajax.postFormData('../php/api/item.php', formData)
    .then(responseJSON => {
        responseJSON.forEach(element => {
            addItemToArray(element)
        });
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
    clearMyItemsArray();
    Ajax.postFormData('../php/api/item.php', formData)
    .then(responseJSON => {
        responseJSON.forEach(element => {
            addMyItemsArray(element)
        });
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
    clearStoresArray();
    Ajax.postFormData('../php/api/store.php', formData)
    .then(responseJSON => {
        responseJSON.forEach(element => {
            addStoreToArray(element)
        });
    })
    .catch(error => {
        console.error('Error:', error); 
    });
}

