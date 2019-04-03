import {Semestre} from "./semestre-modele";

export class Personne {
  constructor(public id: number, public nom: string, public prenom: string, public s1: number, public s2: number, 
    public s3: number, public s4: number, public numero: number, public semestre: Semestre[]) {
  }
}



