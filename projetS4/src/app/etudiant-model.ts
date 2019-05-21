/**
 * Created by hsu on 21/05/19.
 */
import {Semestre} from './semestre-modele';

export class Etudiant {

  id : number;
  nom : string;
  prenom : string;
  avatar : string;
  semestres : Semestre[];

  constructor(values: Object = {}) {
    Object.assign(<Etudiant>this, values);
  }
}
