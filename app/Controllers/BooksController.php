<?php
namespace App\Controllers;

use App\Models\Comment;
use App\Models\Book;
use Sirius\Validation\Validator;

class BooksController extends BaseController {

    /**
     * Ruta [GET] /distros/new que muestra el formulario de añadir una nueva distribución.
     *
     * @return string Render de la web con toda la información.
     */
    public function getNew(){
        $errors = array();  // Array donde se guardaran los errores de validación

        $webInfo = [
            'h1'        => 'Add Book',
            'submit'    => 'Add',
            'method'    => 'POST'
        ];

        // Se construye un array asociativo $distro con todas sus claves vacías
        $book = array_fill_keys(["title", "author", "genre", "publication", "image", "description"], "");

        return $this->render('formBooks.twig', [
            'book'          => $book,
            'errors'        => $errors,
            'webInfo'       => $webInfo
        ]);
    }

    /**
     * Ruta [POST] /distros/new que procesa la introducción de una nueva distribución.
     *
     * @return string Render de la web con toda la información.
     */
    public function postNew(){
        $webInfo = [
            'h1'        => 'Add Book',
            'submit'    => 'Add',
            'method'    => 'POST'
        ];

        if (!empty($_POST)) {
            $validator = new Validator();

            $requiredFieldMessageError = "El {label} es requerido";

            $validator->add('title:Title', 'required',[],$requiredFieldMessageError);
            $validator->add('author:Author', 'required', [], $requiredFieldMessageError);
            $validator->add('genre:Genre', 'required',[], $requiredFieldMessageError);
            $validator->add('publication:Publication','required',[],$requiredFieldMessageError);
            $validator->add('image:Image URL','required',[],$requiredFieldMessageError);
            $validator->add('description:Description','required',[],$requiredFieldMessageError);


            // Extraemos los datos enviados por POST
            $book['title']       = htmlspecialchars(trim($_POST['title']));
            $book['author']      = htmlspecialchars(trim($_POST['author']));
            $book['genre']       = htmlspecialchars(trim($_POST['genre']));
            $book['publication'] = htmlspecialchars(trim($_POST['publication']));
            $book['image']       = htmlspecialchars(trim($_POST['image']));
            $book['description'] = htmlspecialchars(trim($_POST['description']));

            if ($validator->validate($_POST)) {
                $book = new Book([
                    'title'        => $book['title'],
                    'author'       => $book['author'],
                    'genre'        => $book['genre'],
                    'publication'  => $book['publication'],
                    'image'        => $book['image'],
                    'description'  => $book['description'],

                ]);
                $book->save();

                // Si se guarda sin problemas se redirecciona la aplicación a la página de inicio
                header('Location: ' . BASE_URL);
            }else{
                $errors = $validator->getMessages();
            }
        }

        return $this->render('formBooks.twig', [
            'book'          => $book,
            'errors'        => $errors,
            'webInfo'       => $webInfo
        ]);
    }

    /**
     * Ruta [GET] /distros/edit/{id} que muestra el formulario de actualización de una nueva distribución.
     *
     * @param id Código de la distribución.
     *
     * @return string Render de la web con toda la información.
     */
    public function getEdit($id){
        $errors = array();  // Array donde se guardaran los errores de validación

        $webInfo = [
            'h1'        => 'Update Book',
            'submit'    => 'Update',
            'method'    => 'PUT'
        ];

        // Recuperar datos
        $book = Book::find($id);

        if( !$book ){
            header('Location: home.twig');
        }

        return $this->render('formBook.twig',[
            'book'        => $book,
            'errors'        => $errors,
            'webInfo'       => $webInfo
        ]);
    }

    /**
     * Ruta [PUT] /distros/edit/{id} que actualiza toda la información de una distribución. Se usa el verbo
     * put porque la actualización se realiza en todos los campos de la base de datos.
     *
     * @param id Código de la distribución.
     *
     * @return string Render de la web con toda la información.
     */
    public function putEdit($id){
        $errors = array();  // Array donde se guardaran los errores de validación

        $webInfo = [
            'h1'        => 'Update Book',
            'submit'    => 'Update',
            'method'    => 'PUT'
        ];

        if( !empty($_POST)){
            $validator = new Validator();

            $requiredFieldMessageError = "El {label} es requerido";

            $validator->add('title:Title', 'required',[],$requiredFieldMessageError);
            $validator->add('author:Authot', 'required', [], $requiredFieldMessageError);
            $validator->add('genre:Genre', 'required',[], $requiredFieldMessageError);
            $validator->add('publication:Publication','required',[],$requiredFieldMessageError);
            $validator->add('image:Image URL','required',[],$requiredFieldMessageError);
            $validator->add('description:Description','required',[],$requiredFieldMessageError);


            // Extraemos los datos enviados por POST
            $book['title']       = htmlspecialchars(trim($_POST['title']));
            $book['author']      = htmlspecialchars(trim($_POST['author']));
            $book['genre']       = htmlspecialchars(trim($_POST['genre']));
            $book['publication'] = $_POST['publication'];
            $book['image']       = htmlspecialchars(trim($_POST['image']));
            $book['description'] = htmlspecialchars(trim($_POST['description']));

            if ( $validator->validate($_POST) ){
                $distro = Book::where('id', $id)->update([
                    'title'        => $book['title'],
                    'author'       => $book['author'],
                    'genre'        => $book['genre'],
                    'publication'  => $book['publication'],
                    'image'        => $book['image'],
                    'description'  => $book['description'],
                ]);

                // Si se guarda sin problemas se redirecciona la aplicación a la página de inicio
                header('Location: ' . BASE_URL);
            }else{
                $errors = $validator->getMessages();
            }
        }
        return $this->render('formDistros.twig', [
            'book'        => $book,
            'errors'        => $errors,
            'webInfo'       => $webInfo
        ]);
    }

    /**
     * Ruta raíz [GET] /distros para la dirección home de la aplicación. En este caso se muestra la lista de distribuciones.
     *
     * @return string Render de la web con toda la información.
     *
     * Ruta [GET] /distros/{id} que muestra la página de detalle de la distribución.
     * todo: La vista de detalle está pendiente de implementar.
     *
     * @param id Código de la distribución.
     *
     * @return string Render de la web con toda la información.
     */
    public function getIndex($id = null){
        if( is_null($id) ){
            $webInfo = [
                'title' => 'Home Books.net',
                'h1' => 'New'
            ];

            $books = Book::query()->orderBy('id','desc')->get();
            //$books = Book::all();

            return $this->render('home.twig', [
                'books' => $books,
                'webInfo' => $webInfo
            ]);

        }else{
            // Recuperar datos

            $webInfo = [
                'title' => 'Book View'
            ];

            $book = Book::find($id);

            if( !$book ){
                return $this->render('404.twig', ['webInfo' => $webInfo]);
            }

            //dameDato($book);
            return $this->render('distro/distro.twig', [
                'book'    => $book,
                'webInfo'   => $webInfo,
            ]);
        }

    }

    /**
     * Ruta [DELETE] /distros/delete para eliminar la distribución con el código pasado
     */
    public function deleteIndex(){
        $id = $_REQUEST['id'];

        $distro = Book::destroy($id);

        header("Location: ". BASE_URL);
    }

}