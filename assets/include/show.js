const aggiornaShow = eventi => {
    const format = "HH:mm:ss";

    /* CARICAMENTO SLIDE DEGLI EVENTI SULLA PRESENTAZIONE */
    let proiezione = [];

    eventi.map(evento => {
        const orario_inizio = moment(evento['orario_inizio'], format);
        const orario_fine = moment(evento['orario_fine'], format);
        const check_orario = moment().isBetween(orario_inizio, orario_fine);

        if(check_orario) {
            proiezione.push(`
                <section id="evento_${evento['id']}" class="future" data-autoslide="1000" hidden aria-hidden="true" >
                    <img src="/assets/uploads/${evento['multimedia']}"
                         data-src="/assets/uploads/${evento['multimedia']}"
                         style="max-height:500px">
                </section>
            `);
        }
    });

    $(".slides").html(proiezione.join(''));
    $("section:first").removeClass("future").addClass("present").removeAttr("hidden").removeAttr("aria-hidden");
    proiezione = [];
    //////////////////////////////////////////////////////

    // /* POLLING DELLA VALIDITA' DEGLI EVENTI */  bug di aggiornamento, ma caricamento funziona
    setInterval(() => {
        eventi.map(evento => {
            console.log(evento);
            // let orario_inizio = moment(evento['orario_inizio'], format);
            // let orario_fine = moment(evento['orario_fine'], format);
            // let check_orario = moment().isBetween(orario_inizio, orario_fine);
            // let slide = $(`#evento_${evento['id']}`);
            //
            // if(!check_orario && slide.length > 0) {
            //     slide.remove();
            //     console.log("elemento eleminato");
            // }
        });
    }, 5000);
};

if(window.Worker) {
    let myWorker = new Worker("/assets/include/eventi.js");

    sessionStorage.setItem("eventi", JSON.stringify([{}]));
    let stored_eventi = sessionStorage.getItem("eventi");

    myWorker.onmessage = event => {
        let eventi = event.data ? event.data : [{"multimedia":"../images/pi.jpg"}];
        stored_eventi = sessionStorage.getItem("eventi");

        if(JSON.stringify(eventi) !== stored_eventi) {
            sessionStorage.setItem("eventi", JSON.stringify(eventi));
            stored_eventi = sessionStorage.getItem("eventi");
            aggiornaShow(JSON.parse(stored_eventi));
        }
    };
}