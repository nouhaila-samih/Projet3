const form = document.getElementById("myForm");
const liste = document.getElementById("liste");

let personnes = [];

function ajout(){
  const nom1 = form.elements["nom1"].value;
  const prenom1 = form.elements["prenom1"].value;
  const message1 = form.elements["message1"].value;

  if (nom1 === "" || prenom1 === "" || message1 === "") {
    alert("Veuillez remplir tous les champs !");
    return;
  }

  const personne = { nom1, prenom1, message1 };
  personnes.push(personne);

  afficherListe();
  viderFormulaire();
}
const personne = { nom1, prenom1, message1 };
  personnes.push(personne);
function afficherListe(){
  let html = "";
  personnes.forEach((personne) => {
    html += `<p>${personne.nom1} ${personne.prenom1} - ${personne.message1}</p>`;
  });
  liste.innerHTML = html;
}

function viderFormulaire(){
  form.reset();
}
