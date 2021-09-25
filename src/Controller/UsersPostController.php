<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validation;
use App\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;

class UsersPostController extends AbstractController
{
//    #[Route('/users/post', name: 'users_post')]
    
  public function __invoke(Request $request): Response
    {
      $validationErrors = $this->validateRequest($request);
      
      return $validationErrors->count()
         // ? new Response("FAILED VALIDATION !", 200) $this->redirectWithErrors('courses_get', $validationErrors, $request)
          ? new JsonResponse(['type' => 'validation_error', 'title' => 'There was a validation error', 'errors' => $validationErrors],400)
          : $this->createUser($request);
    }

    private function validateRequest(Request $request): ConstraintViolationListInterface
    {
        $constraint = new Assert\Collection(
            [
                'email'     => [new Assert\NotBlank(), new Assert\Length(['min' => 1, 'max' => 255])],
                'name' => [new Assert\NotBlank(), new Assert\Length(['min' => 1, 'max' => 255])],
            ]
        );

        $input = $request->request->all();
        return Validation::createValidator()->validate($input, $constraint);
    }

    private function createUser(Request $request): Response
    {
        
        $input = $request->request->all();
        
        $user = User::create($input["email"],$input["name"]);
        
        $doct = $this->getDoctrine()->getManager(); 
        $doct->persist($user);
        $doct->flush();
       /* $course_creator = new CourseCreator($this->repository,$this->bus,$this->notifier);
        $course_creator->__invoke(
               new CourseId($request->request->getAlpha('id')),
               new CourseName($request->request->getAlpha('name')),
               new CourseDuration($request->request->getAlpha('duration'))
            );
*/
        return new Response("OKEY !", 200);

    }
}
