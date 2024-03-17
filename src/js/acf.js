const readOnlyFields = document.querySelectorAll('.acf-readonly input');
const releaseLimitField =  document.querySelector('.couponSystem__releaseLimit input');
const availableCoupons = document.querySelector('.couponSystem__availableCoupons input');

for (let i = 0; i < readOnlyFields.length; i++) {
    readOnlyFields[i].setAttribute('readonly' , 'readonly');
}

if( releaseLimitField && availableCoupons){
    
    releaseLimitField.addEventListener( 'input' , function(){
        if( Number( availableCoupons.value ) > Number( releaseLimitField.value ) ){
            availableCoupons.value = releaseLimitField.value
        }
    })

    availableCoupons.addEventListener( 'input' , function(){
        if( Number( availableCoupons.value ) > Number( releaseLimitField.value ) ){
            availableCoupons.value = releaseLimitField.value
        }
    })

}