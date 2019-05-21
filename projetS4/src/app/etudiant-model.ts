/**
 * Created by hsu on 21/05/19.
 */
import {Semestre} from './semestre-modele';

export class Etudiant {

  id : number;
  nom : string;
  prenom : string;
  avatar : string;
  //semestres ? : any;
  s1 : number;
  s2 : number;
  s3 : number;
  s4 : number;
  semestre : any;

  constructor(values: Object = {}) {
    Object.assign(<Etudiant>this, values);
  }
}
