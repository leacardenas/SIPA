import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import FormularioRegistro from './FormularioRegistro';
import SeccionRoja from './SeccionRoja';
import PiePagina from './PiePagina';

export default class MainRegistro extends Component{
 
    /*constructor(){
        super()
            this.obtieneInfoUsuario= this.obtieneInfoUsuario.bind(this);
    }

    obtieneInfoUsuario(event){ // Recupera el usuario y la clave
        event.preventDefault();
        const usuario = event.target.elements.usuario.value;
        const nombre = event.target.elements.funcionario.value;
        const correo = event.target.elements.correo.value;
        const numeroTelefono = event.target.elements.numeroTelefono.value;
        
    }*/

    render(){   
        return(
            <div className='contenedor'>
            <section className='pantalla'>
                <SeccionRoja></SeccionRoja>
                <section className='formulario'>
                    <h2 id='tituloFormulario'>Regístrese en SIPA</h2>
                    <FormularioRegistro></FormularioRegistro>
                </section>
            </section>
            </div>
        );
    }
}

if (document.getElementById('mainRegistro')) {
    ReactDOM.render(<MainRegistro/>, document.getElementById('mainRegistro'));
}