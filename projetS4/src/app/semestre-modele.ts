import {Ue} from "./ue-modele";

export class Semestre {
  constructor(public id: number, public moyenne: number, public classement: number, public moyennePromo: number, public promoMax: number, public promoMin: number, public UE: Ue[]) {
  }
}
