import {Injectable} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {environment} from '../environments/environment';

@Injectable({
    providedIn: 'root'
})
export class FileUploadService {
    private readonly apiUrl = environment.apiUrl;
    private avatarUrl = this.apiUrl + 'avatar';

    constructor(private httpClient: HttpClient) {
    }

    sendFile(formData: any) {
        return this.httpClient.post(
            this.avatarUrl, formData).subscribe(
            (response) => {
                console.log(response);
            });
    }
}
