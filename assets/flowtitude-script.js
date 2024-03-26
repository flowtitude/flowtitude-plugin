function cargarScript() {
        console.log("¡El script del plugin Flowtitude se ha cargado correctamente!");
}
// Definición de la función addIconToFields
function addIconToFields(tag, classes, attrArr, balloonText, balloonPosition, onClickFunction, dataUsed, target, appendMethod) {
        console.log("Funciona addIconToFields");

        const li = document.createElement(tag);
        li.classList.add(...classes.split(' '));
        li.setAttribute('data-balloon', balloonText);
        li.setAttribute('data-balloon-pos',balloonPosition);
        if(attrArr && attrArr.length > 0){
            attrArr.forEach(attr => {
                const label = attr[0];
                const value = attr[1];
                li.setAttribute(label, value);
            })
        }
        li.setAttribute('onclick', onClickFunction);
        (dataUsed === true) ? li.setAttribute('data-used', 0) : '';
        li.innerHTML = 'as'; // No se ha especificado contenido, podrías cambiarlo si es necesario
        if(appendMethod === 'after'){
            target ? target.after(li) : console.log('No target to append child.') ;
        } else if (appendMethod === 'before'){
            target ? target.before(li) : console.log('No target to append child.') ;
        } else if (appendMethod === 'child'){
            target ? target.appendChild(li) : console.log('No target to append child.') ;
        } 
    }
    
    // Definición de la función addDynamicVariableIcon
    function addDynamicVariableIcon() {
        console.log("Funciona addDynamicVariableIcon");
        const inputElement = document.querySelector('[data-control="number"] input[type="text"]');
        if (!inputElement) return console.log("No encontrado"); // Verifica si se encontró el input
    
        const wrapper = inputElement.parentElement;
        const modal = wrapper.querySelector('.brxc-toggle-modal');
        if (modal) return; // Verifica si ya existe el icono
    
        // Llama a la función addIconToFields para agregar el icono
        addIconToFields(
            'div',
            'brxc-toggle-modal',
            false,
            'Select CSS Variable',
            'top-right',
            'ADMINBRXC.openVariableModal(event.target.nextElementSibling, "#brxcVariableOverlay", document.querySelector("#brxcVariableOverlay input.iso-search") )',
            false,
            wrapper,
            'before'
        );
    }
    // Llamada a la función cuando se carga el DOM
document.addEventListener("DOMContentLoaded", function() {
        cargarScript();
        addDynamicVariableIcon();
});
    
