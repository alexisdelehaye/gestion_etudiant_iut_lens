export class Personne {
    id: number;
    nom:  string;
    prenom:  string;
    telephone:  string;
    moyenne:number;
    avatar?:  any;
  constructor(id?:number,nom?:string,prenom?:string,telephone?:string,moyenne?:number) {
   this.id=id;
   this.nom=nom;
   this.prenom=prenom;
   this.telephone=telephone;
   this.moyenne=moyenne;
   this.avatar = "assets/img/homme.jpg";
 }
}
