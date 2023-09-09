export class Helper {
    
    ElementsArrayAddClickListener (elements,callback){
        if(elements == null) {
            return null;
        }
        if (elements.length === 0) {
            return null;
        }
        elements.forEach(element => {
            element.addEventListener('click', callback);
        });
    }
    
    ElementsAddClickListener (element,callback){
        if(element == null) {
            return null;
        }
        element.addEventListener('click', callback);
    }

    SelectAllClassWith(element,classname) {
        if(element == null) {
            return null;
        }
        const elements = element.querySelectorAll(classname);
        if (elements.length > 0) {
            return elements;
        }
        return null;
    }

    SelectClassWith(element,classname) {
        if(element == null) {
            return null;
        }
        const elements = element.querySelector(classname);
        if (!elements) {
            return null;
        }
        return elements;
    }

    formatPrice(price) {
        const parts = Number(price).toFixed(2).split('.');
        const integerPart = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        const decimalPart = parts[1];
        return `₱${integerPart}.${decimalPart}`;
      }
}

