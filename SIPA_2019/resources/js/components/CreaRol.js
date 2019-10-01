import React,{Component} from 'react'
import Title from './Title'

class CrearRol extends Component{
    constructor(){
        super()
           
    }

    obtieneRol(event){
        event.preventDefault();
        const nomRol = event.target.elements.nomRol.value;
        const descrip = event.target.elements.descipRol.value;
        const codigo = event.target.elements.codigoRol.value;
    }

    render(){
        return(
            <div>
                <section>
                    <Title title={"Crear Rol de usuario"}/>
                </section>
                <section>
                    <form onSubmit={this.obtieneRol} className = "rolFormulario">
                        <table>
                            <tr>
                                <td>
                                    Nombre de rol &nbsp; &nbsp;
                                </td>
                                <td>
                                    <input type = "text" name = "nomRol"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Descripcion &nbsp; &nbsp;
                                </td>
                                <td>
                                    <input type = "text" name = "descripRol"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Código &nbsp; &nbsp;
                                </td>
                                <td>
                                    <input type = "text" name = "codigoRol"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button>Crear</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </section>
            </div>
        )
    }
}

export default CrearRol