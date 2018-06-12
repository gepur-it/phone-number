---
Class PhoneNumberHelper 
---


Methods:

```yaml

  isUkrainianNumber:
      params:
          $phoneNumber:
              class: GepurIt/PhoneNumber/PhoneNumber
      return:
          false|int
```
```yaml

  isCutUkrainian:
      params:
          $phoneNumber:
              class: GepurIt/PhoneNumber/PhoneNumber
      return:
          boolean

```
          
```yaml
          
  convertToE164IfUkrainian:
      params:
          $phoneNumber:
              class: GepurIt/PhoneNumber/PhoneNumber
      return:
          string

```
