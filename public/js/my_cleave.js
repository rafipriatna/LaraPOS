$('.currency').toArray().forEach(function(field){
    new Cleave(field, {
        numeral: true,
        numeralThousandsGroupStyle: 'thousand',
    });
    console.log(this.value)
});