const templates = [
    `Había una vez un joven llamado {nombres}, aunque sus amigos le decían "{apodo}". Tenía {edad} años, con un cabello de color {colorCabello} y ojos {colorOjos}. Su pasión favorita era {hobby}. Un día, esa pasión lo llevó a descubrir un secreto que cambiaría su vida para siempre.`,
    
    `En un pueblo lejano, vivía {nombres}, conocido cariñosamente como "{apodo}". A sus {edad} años, su cabello {colorCabello} y ojos {colorOjos} contaban historias de aventuras y sueños. Cada día dedicaba tiempo a {hobby}, lo que le daba fuerzas para enfrentar cualquier desafío.`,

    `Dicen que {nombres}, o simplemente "{apodo}", con sus {edad} años, cabello {colorCabello} y ojos {colorOjos}, tenía un don especial. Su hobby favorito, {hobby}, le abrió las puertas a un mundo mágico lleno de posibilidades.`,

    `{nombres}, apodado "{apodo}", era un joven con {edad} años, cabello {colorCabello} y ojos {colorOjos}. Su vida giraba alrededor de {hobby}, una pasión que le enseñó el verdadero significado de la amistad y el coraje.`,

    `La historia de {nombres}, llamado "{apodo}" por sus amigos, es la de un joven de {edad} años, con cabello {colorCabello} y ojos {colorOjos}, que encontró en {hobby} su mayor inspiración para cambiar el mundo.`
];

// Para controlar cuál plantilla usar (opcional si quieres orden, si no aleatorio solo quita esta variable)
let currentIndex = 0;

document.getElementById('cuento-form').addEventListener('submit', function(e) {
    e.preventDefault();

    // Obtener valores del formulario
    const nombres = document.getElementById('nombres').value.trim();
    const apodo = document.getElementById('apodo').value.trim();
    const colorCabello = document.getElementById('colorCabello').value.trim();
    const colorOjos = document.getElementById('colorOjos').value.trim();
    const edad = document.getElementById('edad').value.trim();
    const hobby = document.getElementById('hobby').value.trim();

    // Elegir plantilla (aquí uso rotación en orden)
    const template = templates[currentIndex];

    // Reemplazar placeholders
    const cuento = template
        .replace('{nombres}', nombres)
        .replace('{apodo}', apodo)
        .replace('{colorCabello}', colorCabello)
        .replace('{colorOjos}', colorOjos)
        .replace('{edad}', edad)
        .replace('{hobby}', hobby);

    // Mostrar el cuento
    const resultado = document.getElementById('cuento-result');
    resultado.textContent = cuento;
    resultado.style.display = 'block';

    // Limpiar el formulario para el próximo cuento
    this.reset();

    // Avanzar al siguiente índice o volver al inicio
    currentIndex = (currentIndex + 1) % templates.length;
});
