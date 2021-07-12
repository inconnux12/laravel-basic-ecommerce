function confi(e)
{
   var delet=document.querySelector('#'+e)
    bootbox.confirm('are u sure you want to delete',(res) =>{
        if (res) {
            delet.submit()
        }
    })
   
}

function tables(name, direction, old='id',cat,qry)
{
    link = '/admin/product/index/table'
    div = document.createElement('div')
    table = document.querySelector('.table')
    console.log(direction+'=========>'+old+'=========>'+name)
    if (old == name) {
        if (direction == 'ASC'){
           // direction = 'DESC'
            console.log("1->"+direction)
        }else{
           // direction = 'ASC'
            console.log("2->"+direction)
        }
    } else {
        old = name
    }
    console.log(direction+'=========>'+old+'=========>'+name)
    fetch(link, {
        method: "POST",
        body: JSON.stringify({
            name: name,
            old: direction,
            q: qry,
            categorie: cat
        }),
        headers: {
            "content-type": "application/json; charset=UTF-8",
            "X-Requested-With": "XMLHttpRequest",
            "Accept": "application/json, text-plain, */*",
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }).then(x => x.text()).then(y => {
        div.innerHTML = y;
        let a = document.querySelector('.table').parentNode.replaceChild(div.querySelector('.table'), table)
        let arrow = document.querySelector('.ico-' + name + '-'+direction) 
        arrow.classList.toggle('d-none')
    })
   
}