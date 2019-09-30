import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import FormularioLogin from './FormularioLogin';
import SeccionRoja from './SeccionRoja';
import PiePagina from './PiePagina';
import piePagina from './PiePagina';

export default class MainLogin extends Component{
 /*    constructor(){
        super()
            this.obtieneClaveUsuario= this.obtieneClaveUsuario.bind(this);
    } */

 /*    obtieneClaveUsuario(event){ // Recupera el usuario y la clave
        event.preventDefault();
        const usuario = event.target.elements.usuario.value;
        const clave = event.target.elements.clave.value;
        
    } */

    render(){   
        return(
            <div className='contenedor'>
            <section className='pantalla'>
                <SeccionRoja></SeccionRoja>
                <section className='formulario'>
                    <h2 id='tituloFormulario'>Acceda a su cuenta</h2>
                    <FormularioLogin></FormularioLogin>
                </section>
            </section>
            </div>
        );
    }
}

if (document.getElementById('mainLogin')) {
    ReactDOM.render(<MainLogin/>, document.getElementById('mainLogin'));
}