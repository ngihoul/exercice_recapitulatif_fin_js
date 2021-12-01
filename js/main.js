// DECLARATION DES CONSTANTES

// Récupération du tableau html, des formulaires et du bouton sauvegarder pour MAJ location
const TABLE_RENTALS = document.getElementById("locations");
const EDIT_LOCATION_FORM = document.getElementById("edit_location");
const SHOW_USER_FORM = document.getElementById("show_user");
const EDIT_SUBMIT_BTN = document.getElementById("submit_form");

// Définition des TH du tableau html des locations en français (en anglais dans DB).
const THEAD_LABELS = [
  "ID",
  "Titre",
  "Durée(min)",
  "Année de sortie",
  "Id utilisateur",
  "Actions",
];

// DECLARATION DES FONCTIONS

// Gestion des locations
let Rentals = {
  // Récupérer et afficher les locations
  getRentals: (method, url, params = null) => {
    let datas;
    const XHR = new XMLHttpRequest();
    XHR.onreadystatechange = function () {
      switch (XHR.readyState) {
        case XHR.DONE:
          if (XHR.status === 200) {
            // Récupérer les données
            // QUESTION : pourquoi ne peut-on pas retourner directement le tableau datas ?
            datas = JSON.parse(XHR.responseText);
            // Creation du tableau HTML avec les données reçues
            HTMLTable.createHTMLTable(TABLE_RENTALS, THEAD_LABELS, datas);
          }
          break;
      }
    };
    XHR.open(method, url);
    XHR.send(params);
  },
};

// Actions sur une location
let Rental = {
  // Récupérer et affiche une location
  getRental: (e) => {
    let id = parseInt(e.target.getAttribute("data-id")) - 1;
    let datas;

    const XHR = new XMLHttpRequest();
    XHR.onreadystatechange = function () {
      switch (XHR.readyState) {
        case XHR.DONE:
          if (XHR.status === 200) {
            // Récupérer les données
            // QUESTION : pourquoi ne peut-on pas retourner directement le tableau datas ?
            datas = JSON.parse(XHR.responseText);
            Form.showForm(EDIT_LOCATION_FORM);
            Form.hideForm(SHOW_USER_FORM);
            Form.fillForm(datas[id]);
            Form.changeTitle("h2", "Edition d'une location");
            EDIT_SUBMIT_BTN.removeAttribute("disabled");
          }
          break;
      }
    };
    XHR.open("GET", "read_all_movie_rentals.php");
    XHR.send(null);

    return datas;
  },
  // Mettre à jour une location
  editRental: (e) => {
    e.preventDefault();
    // Récupération des valeurs introduites dans le formulaire
    let id = document.querySelector("#edit_location #id").value;
    let title = document.querySelector("#edit_location #title").value;
    let length = document.querySelector("#edit_location #length").value;
    let year = document.querySelector("#edit_location #year").value;
    let user_id = document.querySelector("#edit_location #user_id").value;

    const METHOD = "POST";
    const URL = "update_movie_rental.php";

    let params = `id=${id}&title=${title}&length=${length}&year=${year}&user_id=${user_id}`;

    let xhr = new XMLHttpRequest();

    xhr.onreadystatechange = () => {
      switch (xhr.readyState) {
        case xhr.DONE:
          if (xhr.status === 200) {
            // Réinitialisation du tableau
            TABLE_RENTALS.textContent = "";
            Rentals.getRentals("GET", "read_all_movie_rentals.php");
          }
          break;
      }
    };

    xhr.open(METHOD, URL);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(params);
  },
  // Supprimer une location
  deleteRental: (e) => {
    // Suppression dans le DOM
    let parent = e.target.parentNode;
    parent.parentNode.removeChild(parent);
    // TO DO : suppression dans la DG via AJAX POST
  },
};

// Création des éléments HTML
let HTMLTable = {
  createHTMLTable: (destination, label_header, datas) => {
    // Creation du <thead>
    let thead = document.createElement("thead");
    let thead_tr = document.createElement("tr");
    for (let label of label_header) {
      let thead_th = document.createElement("th");
      thead_th.textContent = label;
      thead_tr.appendChild(thead_th);
    }
    thead.appendChild(thead_tr);
    destination.appendChild(thead);

    // Création du tbody
    let tbody = document.createElement("tbody");
    for (let data of datas) {
      // Creation d'un TR par élément reçu
      let tbody_tr = document.createElement("tr");
      let keys = getKeysFromObject(data);
      for (let key of keys) {
        let tbody_td = document.createElement("td");
        if (key === "user_id") {
          let link = HTMLTable.createLink(data[key], "#");
          link.dataset.id = data[key];
          link.addEventListener("click", User.getUser, false);
          tbody_td.appendChild(link);
        } else {
          tbody_td.textContent = isNaN(data[key])
            ? firstLetterToUpper(data[key])
            : data[key];
        }
        tbody_tr.appendChild(tbody_td);
      }

      // Ajout d'un bouton éditer
      let btn_edit = HTMLTable.createLink("Editer", "#", "btn btn-primary");

      // Ajout event editRental() sur btn_edit au click
      btn_edit.addEventListener("click", Rental.getRental, false);
      btn_edit.dataset.id = data.id;
      tbody_tr.appendChild(btn_edit);

      // Ajout d'un bouton Supprimer
      let btn_delete = HTMLTable.createLink("Supprimer", "#", "btn btn-danger");

      // Ajout event deleteRental sur btn_delete au click
      btn_delete.addEventListener("click", Rental.deleteRental, false);
      btn_delete.dataset.id = data.id;
      tbody_tr.appendChild(btn_delete);

      tbody.appendChild(tbody_tr);
    }
    destination.appendChild(tbody);
  },

  // Ajoute un lien
  createLink: (label, link = "#", css_classes = null) => {
    let btn = document.createElement("a");
    btn.classList = css_classes;
    btn.href = link;
    btn.textContent = label;
    return btn;
  },
};

// Gestion des formulaires
let Form = {
  // Rempli un formulaire avec les données reçues sous forme d'objet
  fillForm: (datas) => {
    let i;
    let keys = getKeysFromObject(datas);
    const KEYS_SIZE = keys.length;
    for (i = 0; i < KEYS_SIZE; i++) {
      // TO DO : Adapter pour l'affichage d'un utilisateur
      let attribute = document.getElementById(keys[i]);
      // Exception pour le password qui ne doit pas être affiché
      if (attribute !== null) {
        attribute.value = datas[keys[i]];
      }
    }
  },
  // Affiche le formulaire adéquat
  showForm: (form) => {
    form.style.display = "block";
  },
  // Cache un formulaire
  hideForm: (form) => {
    form.style.display = "none";
  },
  // Change le titre du formulaire
  changeTitle(target, new_title) {
    let title = document.getElementsByTagName(target);
    title[0].textContent = new_title;
  },
};

// Gestion des utilisateurs
let User = {
  // Récupère et affiche les données d'un utilisateur
  getUser: (e) => {
    let id = e.target.getAttribute("data-id");
    let method = "GET";
    let url = `read_user.php?id=${id}`;
    let params = null;

    const XHR = new XMLHttpRequest();
    XHR.onreadystatechange = function () {
      switch (XHR.readyState) {
        case XHR.DONE:
          if (XHR.status === 200) {
            // Récupérer les données
            // QUESTION : pourquoi ne peut-on pas retourner directement le tableau datas ?
            let datas = JSON.parse(XHR.responseText);
            Form.showForm(SHOW_USER_FORM);
            Form.hideForm(EDIT_LOCATION_FORM);
            Form.fillForm(datas);
            Form.changeTitle("h2", "Affichage des données de l'utilisateur");
          }
          break;
      }
    };
    XHR.open(method, url);
    XHR.send(params);
  },
};

let Warning = {
  create: () => {
    const div = createElement("div");
  },
};

// Récupère les clefs d'un objet.
function getKeysFromObject(obj) {
  return Object.keys(obj);
}

function firstLetterToUpper(txt) {
  return txt.charAt(0).toUpperCase() + txt.substring(1).toLowerCase();
}

// EXECUTION SCRIPT

// Initialisation du script >> Récupérer et afficher les locations
let rentals = Rentals.getRentals("GET", "read_all_movie_rentals.php");

// Mise à jour d'une location
EDIT_SUBMIT_BTN.addEventListener("click", Rental.editRental, false);
