import React,{Components} from 'react'
import Subtitulo from './Sipa'
import Title from './Titulo'


class Registro extends Components{
    constructor(){
        super()
            this.obtieneInfoUsuario= this.obtieneInfoUsuario.bind(this);
    }

    obtieneInfoUsuario(event){ // Recupera el usuario y la clave
        event.preventDefault();
        const usuario = event.target.elements.usuario.value;
        const nombre = event.target.elements.funcionario.value;
        const correo = event.target.elements.correo.value;
        const numeroTelefono = event.target.elements.numeroTelefono.value;
        
    }

    render(){
        return (
            <div>
                <div className ="form">
                    <section className="registroRojo">
                        <div>
                            <Subtitulo/>.
                        </div>
                        <div>
                            <img/>
                        </div>
                    </section>
                    <section className = "tituloRegistro">
                        <Title title = {"Resgístrate en SIPA"}/>
                    </section>
                    <section className = "formularioRegistro">
                        <form onSubmit={this.obtieneClaveUsuario}>
                            <div>
                                <label for ="usuario" className = "labelUsuarioRegistro">Usuario</label>
                                <input type = "text"  name="usuario" />
                            </div>
                            <div>
                                <label for ="nomFuncionaro" className = "labelFuncRegistro">Nombre de Funcionario</label>
                                <input type = "text"name="funcionario"/>
                            </div>
                            <div>
                                <label for = "correo" className= "labelCorreoRegistro">Correo Electrónico</label>
                                <input type = "text" placeholder="Ingrese su correo electrónico" name ="correo"/>
                            </div>
                            <div>
                                <label for = "telefono" className= "labelTelefRegistro">Teléfono</label>
                                <input type = "text" paceholder="Ingrese su número de telefono" name = "numeroTelefono"/>
                            </div>
                            <div>
                            <select className = "edificioBox">
                                <option value="opcion1">Edificio 1</option>
                                <option value="opcion2">Edificio 2</option>
                                
                            </select>
                            <select className = "pisoBox">
                                <option value="opcion1">Piso 1</option>
                                <option value="opcion2">Piso 2</option>
                                
                            </select>
                            <select className = "unidadBox">
                                <option value="opcion1">Unidad 1</option>
                                <option value="opcion2">Unidad 2</option>
                                
                            </select>
                            </div>
                            <button>Registrarse</button>
                        </form>
                        <div>
                            <p><a href="index.jsp"> Olvidé mi contraseña </a>
                            </p>
                        </div>
                    </section>
                </div>
            </div>
        )
    }
}


export default Registro