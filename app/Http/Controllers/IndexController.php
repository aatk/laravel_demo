<?php

namespace App\Http\Controllers;

use App\Models\UsersDB;
use Database\Factories\UsersDBFactory;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function install()
    : Response
    {
        //@Get("/api/install")

        $maxcount    = 1000;
        $firstnames  = [ "Александр", "Иван", "Максим", "Олег", "Марат", "Людмила", "Оксана" ];
        $secondnames = [ "Ткаченко", "Жуков", "Чкалов", "Путин", "Шамузинов", "Дахно", "Карась" ];
        $surnames    = [ "Александрович", "Иванович", "Максимович", "Олегович", "Маратович", "Евгеньевич", "Джонович" ];


        $UsersDBFactory = new UsersDBFactory();
        $count = $UsersDBFactory->countItems();

        $ID = false;
        if ($count < $maxcount)
        {
            for ($next_item = $count; $next_item < $maxcount; $next_item++)
            {
                //заполним таблицу
                $rnd_f  = rand(0, 6);
                $rnd_s  = rand(0, 6);
                $rnd_ss = rand(0, 6);

                $Users = new UsersDB();
                $Users->setFirstname($firstnames[$rnd_f]);
                $Users->setSecondname($secondnames[$rnd_s]);
                $Users->setSurname($surnames[$rnd_ss]);
                $Users->save();
                $ID = $Users->getId();
            }
        }

        $res = [ 'result' => $ID ];

        return response()->json($res);
    }


    public function getid($id)
    : Response
    {
        //@Get("/api/get/{id}")
        $result = new Response();
        $result->setStatusCode(404);

        $id     = $id ?? 0;
        if ($id > 0)
        {
            $usersRepository = new UsersDBFactory();
            $UserArray       = [];
            $UserArray[]     = $usersRepository->find($id);//->toArray();

            $result = response()->json($UserArray);
        }

        return $result;
    }


    public function list($id, $limit)
    : Response
    {
        // @Get("/api/list/{id}/{limit}")
        $result = new Response();
        $result->setStatusCode(404);

        $result->setContent($id." - ".$limit);
        $id     = $id ?? 0;
        $limit  = $limit ?? 1;
        if ($id > 0)
        {
            $usersRepository = new UsersDBFactory();
            $Users           = $usersRepository->findById($id, $limit);
            $result          = response()->json($Users);
        }

        return $result;
    }

    public function search($find, $id, $limit)
    : Response
    {
        //@Get("/api/search/{find}/{id}/{limit}")
        $result = new Response();

        $usersRepository = new UsersDBFactory();
        $findresult      = $usersRepository->findByText($find, $id, $limit);
        $result          = response()->json($findresult);

        return $result;
    }

    private function saveUsers($json)
    {
        $result = false;
        if (isset($json["firstname"]) && isset($json["secondname"]) && isset($json["surname"]))
        {
            $UserId = false;

            $User = new UsersDB();
            $User->setFirstname($json["firstname"]);
            $User->setSecondname($json["secondname"]);
            $User->setSurname($json["surname"]);
            if (isset($json["id"]))
            {
                $User->setId($json["id"]);
                if ($User->update())
                {
                    $UserId = $User->getId();
                }
            }
            else {
                $User->save();
                $UserId = $User->getId();
            }

            if ($UserId)
            {
                $result = $User;
            }
        }

        return $result;
    }

    public function post()
    : Response
    {
        //@Post("/api/post")
        $result = new Response();
        $result->setStatusCode(404);

        $content    = (new Request())->getContent();
        $json_items = json_decode($content, true);
        foreach ($json_items as $json)
        {
            unset($json["id"]);
            $UserInfo = $this->saveUsers($json);
            if ($UserInfo)
            {
                $UserInfoArray   = [];
                $UserInfoArray[] = json_decode(response()->json($UserInfo)->getContent(), true);
                $result          = response()->json($UserInfoArray)->setStatusCode(201);
            }
        }

        return $result;
    }

    public function put()
    : Response
    {
        //@Put("/api/put")
        $result = new Response();
        $result->setStatusCode(404);

        $content    = (new Request())->getContent();
        $json_items = json_decode($content, true);
        foreach ($json_items as $json)
        {
            $id = $json["id"] ?? 0;
            if ($id > 0)
            {
                $UserInfo = $this->saveUsers($json);
                if ($UserInfo)
                {
                    $result->setStatusCode(201);
                }
            }
        }

        return $result;
    }

    public function delete()
    : Response
    {
        //@Delete("/api/delete")
        $result = new Response();
        $result->setStatusCode(404);

        $content    = (new Request())->getContent();
        $json_items = json_decode($content, true);
        foreach ($json_items as $json)
        {

            $id = $json["id"] ?? 0;
            if ($id > 0)
            {
                $User = new UsersDB();
                $User->setId($id);
                if ($User->delete())
                {
                    $result->setStatusCode(201);
                }
            }
        }

        return $result;
    }


}
